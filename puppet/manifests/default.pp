Exec {
  path => ["/usr/bin", "/bin", "/usr/sbin", "/sbin", "/usr/local/bin", "/usr/local/sbin"]
}

class bootstrap {
  # node
  apt::source { 'debian_sid':
    location          => 'http://ftp.lt.debian.org/debian/',
    release           => 'sid',
    repos             => 'main contrib non-free',
    required_packages => 'debian-keyring debian-archive-keyring',
    key               => '46925553',
    key_server        => 'subkeys.pgp.net',
    pin               => '1',
    include_src       => true
  }

  # libc6
  apt::source { 'debian_backports':
    location          => 'http://ftp.litnet.lt/debian/',
    release           => 'wheezy-backports',
    repos             => 'main contrib non-free',
    required_packages => 'debian-keyring debian-archive-keyring',
    key               => '46925553',
    key_server        => 'subkeys.pgp.net',
    pin               => '700',
    include_src       => true
  }

  # php 5.6
  apt::source { 'packages.dotdeb.org-php':
    location          => 'http://packages.dotdeb.org',
    release           => 'wheezy-php56',
    repos             => 'all',
    required_packages => 'debian-keyring debian-archive-keyring',
    key               => '89DF5277',
    key_server        => 'keys.gnupg.net',
    pin               => '800',
    include_src       => true
  }
}

stage { "init":    before  => Stage["main"] }
stage { "post":    require => Stage["main"] }

class {"bootstrap":
  stage => init
}

class { "apt":
  stage => init
}

# apache
package { "apache2":
  ensure  => present,
  require => Exec["apt_update"]
}

file { "/etc/apache2/mods-enabled/rewrite.load":
  ensure  => link,
  target  => "/etc/apache2/mods-available/rewrite.load",
  require => Package["apache2"]
}

file { "/etc/apache2/mods-enabled/php5.load":
  ensure  => link,
  target  => "/etc/apache2/mods-available/php5.load",
  require => [
      Package["apache2"],
      Package["libapache2-mod-php5"],
  ]
}

file { "/etc/apache2/mods-enabled/php5.conf":
  ensure  => link,
  target  => "/etc/apache2/mods-available/php5.conf",
  require => [
      Package["apache2"],
      Package["libapache2-mod-php5"],
  ]
}

file { "/etc/apache2/sites-available/default":
  ensure  => present,
  source  => "puppet:///librarian/apache/vhost",
  require => Package["apache2"],
}

service { "apache2":
  ensure    => running,
  require   => Package["apache2"],
  subscribe => [
    File["/etc/apache2/sites-available/default"],
    File["/etc/apache2/mods-enabled/php5.load"],
    File["/etc/apache2/mods-enabled/php5.conf"],
  ]
}

# mysql
package { "mysql-server":
  ensure => present,
  require => Exec["apt_update"]
}

#php
$php_required = [
  "php5",
  "php5-cli",
  "php5-mysql",
  "php5-dev",
  "php5-gd",
  "php5-mcrypt",
  "libapache2-mod-php5",
  "php5-curl",
  "php5-intl",
]

$php_purge = [
  "php5-suhosin"
]

package { $php_required:
  ensure  => present,
  require => Exec["apt_update"]
}

package { $php_purge:
  ensure  => purged,
  require => Package["php5"],
  notify  => Package["apache2"]
}

class { 'composer':
  target_dir      => '/usr/local/bin',
  composer_file   => 'composer',
  download_method => 'curl',
  logoutput       => false,
  tmp_path        => '/tmp',
  curl_package    => 'curl',
  wget_package    => 'wget',
  composer_home   => '/home/vagrant',
  php_bin         => 'php',
  suhosin_enabled => false,
  require         => [
    Package['php5-suhosin'],
    Package['php5-cli']
  ]
}

# psysh
exec { "composer install psysh":
  command => 'su vagrant -c "composer g require psy/psysh:@stable"',
  onlyif  => "test ! -e /home/vagrant/.composer/vendor/bin/",
  require => Class["composer"]
}

file { "/home/vagrant/.psysh":
  ensure => directory,
  owner => "vagrant",
  group => "vagrant",
}

exec { "psysh php manual":
  command => "wget -O /home/vagrant/.psysh/php_manual.sqlite http://psysh.org/manual/en/php_manual.sqlite",
  onlyif  => "test ! -e /home/vagrant/.psysh/php_manual.sqlite",
  require => [
    Exec["composer install psysh"],
    File["/home/vagrant/.psysh"]
  ]
}
class { "mailcatcher":
  smtp_ip => "0.0.0.0",
  http_ip => "0.0.0.0",
}

# gems
class gems {
  $gems = [
    { name => "compass",      version => "latest" },
    { name => "sass",         version => "latest" },
    { name => "less",         version => "latest" },
    { name => "therubyracer", version => "latest" },
  ]

  define install_gem {
    package { $name[name]:
      provider => "gem",
      ensure   => $name[version],
    }
  }

  install_gem {$gems: }
}

class {"gems":
  stage => post
}

# node
class {"nodejs": } ->
package { "nodejs-legacy":
  ensure => present,
}

package { "augeas-tools":
  ensure => present,
}

package { "libaugeas-ruby":
  ensure => present,
}

class conf {
  augeas { "php-errors":
    changes => [
      "set /files/etc/php5/apache2/php.ini/PHP/display_errors On",
      "set /files/etc/php5/cli/php.ini/PHP/display_errors On",
    ],
  }

  augeas { "php-time":
    changes => [
      "set /files/etc/php5/apache2/php.ini/PHP/date.timezone Europe/Vilnius",
      "set /files/etc/php5/cli/php.ini/PHP/date.timezone Europe/Vilnius",
    ],
  }

  exec { "composer-vendor-path":
    command => "echo 'export PATH=\$PATH:/home/vagrant/.composer/vendor/bin' >> /home/vagrant/.bashrc; touch /home/vagrant/.composer-path",
    creates => "/home/vagrant/.composer-path",
    user    => "vagrant"
  }
}

class {"conf":
  stage => post
}