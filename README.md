[![TravisCI Status](https://travis-ci.org/nfqakademija/atotrukis.svg?branch=master)](https://travis-ci.org/nfqakademija/atotrukis)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nfqakademija/atotrukis/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nfqakademija/atotrukis/?branch=master)
# akademija.dev
Tai virtuali mašina siūloma naudoti akademijos projektams.

### Reikalavimai
- Vagrant (>=1.5.1)
- Virtualbox
- nfs daemon (linux)

### Rekomendacijos
- vagrant host updater plugin (`vagrant plugin install vagrant-hostsupdater`) 

### Paketai
- Apache2
- PHP 5.6 (cli bei mod_php)
- MySQL
- [mailcatcher gem] \(smtp port'as 1025, web interface 192.168.10.42:1080)
- [compass gem]
- [sass gem]
- [less gem]
- [nodejs]
- [psysh] \(su dokumentacijos duombaze)
- [composer] \(globalus)

### Paleidimas
Linux pirma reikia pasirūpinti, kad vagrant galėtu naudotis `nfs` (windows bus parenkama `smb` kuris būna iškarto surašytas). Ubuntu tam reikia įrašyti `nfs-kernel-server` paketą: `sudo apt-get install nfs-kernel-server`. Kitose distribucijose reikia ieškoti `nfs-server` ir `nfs-utils` tipo paketų bei sukonfiguruoti daemon'ą, kad būtu naudojama 3-čia protokolo versija.

Kai host aplinka paruošta, užtenka paleisti `vagrant up` kataloge su `Vagrantfile`. Vagrant paleis vm'ą bei surašys reikalingus paketus. Vm'ą sustabdyti galite su `vagrant suspend` (windows hibernate atitikmuo) ar `vagrant halt` (išjungimas). Paleidžiama su ta pačia `vagrant up` komanda. Atsinaujinus provision'ams (bet kam puppet kataloge), surašytus paketus galite atnaujinti paleidę `vagrant provision`.

Katalogas kuriame yra `Vagrantfile` yra sinchorinizuojamas su vm'u ir apache yra sukonfiguruotas atidaryti `web` katalogo turinį.

Į vm galite prisijungti su `vagrant ssh`. Jam suteikiamas `192.168.10.42` ip. Koks bus jūsų ip tarp ssh sesijų nėra garantuojama. Jei bus įrašytas hosts updater plugin, vm paleidimo metu bus atnaujintas jūsų hosts map'as ir vm'ą taip pat galėsit pasiekti `akademija.dev` adresu.


[sass gem]:http://sass-lang.com/
[mailcatcher gem]:http://mailcatcher.me/
[less gem]:http://lesscss.org/
[nodejs]:http://nodejs.org/
[compass gem]:http://compass-style.org/
[psysh]:http://psysh.org/
[composer]:https://getcomposer.org/
