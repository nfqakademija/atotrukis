Vagrant.require_version ">= 1.5.1"
Vagrant.configure("2") do |config|

  config.vm.box = "nfq/wheezy"

  $librarian = <<BASH
    apt-get update
    apt-get install -y git build-essential ruby-dev
    gem install librarian-puppet
    mkdir /tmp/librarian/ >/dev/null
    cp /vagrant/puppet/Puppetfile /tmp/librarian/
    cd /tmp/librarian/
    librarian-puppet install --clean
    rsync -rut /vagrant/puppet/* /tmp/librarian
BASH

  config.vm.define 'atotrukis', primary: true do |atotrukis|
    atotrukis.vm.network "private_network", ip: "192.168.10.42"
    atotrukis.vm.hostname = "atotrukis.dev"

    atotrukis.vm.provision "shell", inline: $librarian

    atotrukis.vm.provision :puppet do |puppet|
      puppet.manifests_path = ["vm", "/tmp/librarian/manifests"]
      puppet.working_directory = "/tmp/librarian"

      puppet.options = [
        "--verbose",
        "--modulepath", "/tmp/librarian/modules",
        "--fileserverconfig", "/tmp/librarian/fileserver.conf"
      ]
    end

    atotrukis.vm.provider :virtualbox do |vb|
      vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
      vb.customize ["modifyvm", :id, "--memory", 512, "--cpus", 2]
      vb.name = "atotrukis.dev"
    end
    atotrukis.vm.synced_folder ".", "/var/www"
  end

end
