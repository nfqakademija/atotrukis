Vagrant.require_version ">= 1.5.1"
Vagrant.configure("2") do |config|

  mount = "smb"
  mount = "nfs" if RUBY_PLATFORM =~ /linux/
  mount = nil if RUBY_PLATFORM =~ /darwin/

  config.vm.box = "nfq/wheezy"

  $librarian = <<BASH
    apt-get update
    apt-get install -y git
    gem install librarian-puppet
    mkdir /tmp/librarian/ >/dev/null
    cp /vagrant/puppet/Puppetfile /tmp/librarian/
    cd /tmp/librarian/
    librarian-puppet install --clean
    rsync -rut /vagrant/puppet/* /tmp/librarian
BASH

  config.vm.define 'akademija', primary: true do |akademija|
    akademija.vm.network "private_network", ip: "192.168.10.42"
    akademija.vm.hostname = "akademija.dev"

    akademija.vm.provision "shell", inline: $librarian

    akademija.vm.provision :puppet do |puppet|
      puppet.manifests_path = ["vm", "/tmp/librarian/manifests"]
      puppet.working_directory = "/tmp/librarian"

      puppet.options = [
        "--verbose",
        "--modulepath", "/tmp/librarian/modules",
        "--fileserverconfig", "/tmp/librarian/fileserver.conf"
      ]
    end

    akademija.vm.provider :virtualbox do |vb|
      vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
      vb.customize ["modifyvm", :id, "--memory", 512, "--cpus", 2]
      vb.name = "akademija.dev"
    end
    akademija.vm.synced_folder ".", "/var/www", type: mount
  end

end
