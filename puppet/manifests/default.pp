Exec {
  path => ["/usr/bin", "/bin", "/usr/sbin", "/sbin", "/usr/local/bin", "/usr/local/sbin"]
}

class bootstrap {
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

  apt::source { 'packages.dotdeb.org-php':
    location          => 'http://packages.dotdeb.org',
    release           => 'wheezy',
    repos             => 'all',
    required_packages => 'debian-keyring debian-archive-keyring',
    key               => '89DF5277',
    key_server        => 'keys.gnupg.net',
    pin               => '800',
    include_src       => true
  }
}

stage { "init":    before  => Stage["main"] }
stage { "cleanup": require => Stage["main"] }

class {'bootstrap':
  stage => init
}

class { 'apt':
  stage => init
}

package { "apache2":
  ensure  => present,
  require => Exec["apt_update"]
}

file { "/etc/apache2/mods-enabled/rewrite.load":
  ensure  => link,
  target  => "/etc/apache2/mods-available/rewrite.load",
  require => Package["apache2"]
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
    File["/etc/apache2/sites-available/default"]
  ],
}

package { "mysql-server":
  ensure => present,
  require => Exec["apt_update"]
}

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
  "php5-memcached",
]

$php_purge = [
  'php5-suhosin'
]

package { $php_required:
  ensure  => present,
  require => Exec["apt_update"]
}

package { $php_purge:
  ensure  => purged,
  require => Package['php5'],
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
