-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2014 at 03:27 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.3-1~dotdeb.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atotrukis`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `priority`) VALUES
(1, 'casada', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `createdOn` datetime NOT NULL,
  `map` varchar(2083) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5387574AD3564642` (`createdBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `city`, `name`, `description`, `startDate`, `endDate`, `createdOn`, `map`, `createdBy`) VALUES
(12, ' Lietuva ', 'Festivalis ''''KILKIM ŽAIBU'''' 2015 ', '<div style="text-align: justify;">\n	<strong><br />\n	<br />\n	Festivalis KILKIM ŽAIBU grįžta į Žiemgalą!</strong><br />\n	<br />\n	Gimęs Žiemgalos regione, Joniškyje, senųjų tradicijų ir sunkiosios muzikos festivalis KILKIM ŽAIBU paskutiniuosius 5-erius metus vyko Žemaitijoje, Varniuose. Žemaitijoje atšventę 15 metų jubiliejų, trokšdami atsinaujinimo ir naujų potyrių, mes vėl leidomės į naujos erdvės paieškas. Šį kartą pasirinkome Lietuviškos Žiemgalos sostinę – Žagarę.<br />\n	Festivalis KILKIM ŽAIBU XVI vyks 2015 m. birželio 26-27 d. Žagarėje, šalia istoriškai svarbaus Žiemgalos kraštui Raktės piliakalnio, Žvelgaičio ežero pakrantėje. Žiemgalos kraštui pagerbti skirto festivalio tema – grįžimas prie savo šaknų, amžinai besisukantis ratas, praeities ir ateities susiliejimas dabartyje.<br />\n	<br />\n	Vienas seniausių šalies miestų – Žagarė – 2015-aisiais bus metų Lietuvos kultūros sostinė. Festivalis KILKIM ŽAIBU jau yra įtrauktas į kultūros sostinės renginių sąrašą. Ar festivalio viešnagė į Žagarę užtruks daugiau nei vienerius metus, kol kas nežinome, bet esame tikri, kad festivalis ateinančiais metais Žagarėje trenks pilna jėga! Renginys truks viena diena trumpiau nei įprastai ¬¬– jis vyks dvi dienas ir dvi naktis. Bet tai bus tikra „Žaibo koncentracija“, orientuota į kokybę, o ne į kiekybę – kokybiškas, išgrynintas ir ambicingas „Žaibų“ žygis į Žiemgalą!<br />\n	Svarbu paminėti, kad pradedant naują „Žaibų“ festivalio ratą, atsinaujina ir organizatorių gretos. Festivalis nenukryps toli nuo savo idėjinio kamieno, bet mes nesistengiame laikytis varžančių klišių ir laužome visas įsigalėjusias ir iš dalies primestas festivaliui ribas. Mums nėra svarbu, kokiais pavadinimais įvardinti kolektyvų, kurie pas mus dalyvauja, muzikiniai žanrai. Mums svarbu, kad festivalis bręstu kaip gyvas organizmas kartu su mumis ir mumyse. Festivalis išlieka mūsų vizijoje kaip žadinanti, gyvybingumu trykštanti bekompromisinė energija, kartą per metus pakylėjanti savo lankytojus į kitą erdvės, emocijų kulminacijos ir laikmečio pajautimą. Todėl galite nusiteikti pačių įvairiausių, ekstremaliausių, pikantiškiausių ir originaliausių kokybiškos muzikos kūrėjų apsilankymo mūsų renginyje. Festivalis kryptingai žengia toliau pasirinktu sunkiosios muzikos&nbsp; gurmanų keliu.<br />\n	<br />\n	Pirmieji festivalio dalyviai:<br />\n	KING OF ASGARD – viking metalo veteranai iš Švedijos;<br />\n	BÖLZER – unikalaus metalo kūrėjai iš Šveicarijos;<br />\n	<br />\n	Viso festivalyje bus virš 30 kolektyvų iš 11 valstybių. Apie juos, kaip įprasta, pranešime vėliau, nes laiko turime dar tikrai daug.<br />\n	<br />\n	Bilietus į festivalį KILKIM ŽAIBU XVI galite įsigyti dviems dienoms arba vienai pasirinktai atskirai. Vienos dienos bilietus bus galima įsigyti tik festivalio metu renginio vietoje.<br />\n	Bilietų skaičius yra neribotas. Tačiau patariame jais pasirūpinti iš anksto.<br />\n	BILIETŲ KAINOS<br />\n	Pirmieji 300 bilietų kainuos po 85 Lt.<br />\n	Vėliau bilietai brangs.<br />\n	Vaikams iki 12 metų (imtinai) įėjimas nemokamas.<br />\n	Neįgaliems ir senjorams (pensininkams) nuolaida bilietui - 50 proc.<br />\n	Vienos dienos bilietus ir bilietus su nuolaida galima įsigyti TIK FESTIVALYJE prie įvažiavimo.<br />\n	<br />\n	Sekite informaciją:<br />\n	<a href="http://www.kilkimzaibu.com" target="_blank">www.kilkimzaibu.com</a><br />\n	<br />\n	Draugaukime:<br />\n	<a href="http://lt-lt.facebook.com/kilkimzaibu" target="_blank">http://lt-lt.facebook.com/kilkimzaibu</a><br />\n	<br />\n	Festivalio video:<br />\n	<a href="https://www.youtube.com/watch?v=9x7W0VpSsLE" target="_blank">https://www.youtube.com/watch?v=9x7W0VpSsLE</a><br />\n	<a href="https://www.youtube.com/watch?v=HP8ev2YMqlg" target="_blank">https://www.youtube.com/watch?v=HP8ev2YMqlg</a><br />\n	<br />\n	&nbsp;</div>\n<strong>', '2015-06-26 00:00:00', '2015-06-27 00:00:00', '2014-12-08 20:34:31', '(56.3558489, 23.2444449)', NULL),
(13, ' Vilnius ', 'Šventinis Koncertas: Mantra improvizacijos ', '<div style="text-align: justify;">\n	<strong></strong><br />\n	<br />\n	Antrą Kalėdų dieną kviečiame i meditacinės muzikos koncertą, kuriame skambės muzikinės improvizacijos mantrų tekstais. Puikus koncertas šventiniam periodui. Geros energijos plūpsnis į jūsų širdis!<br />\n	Tai labiau bendra praktika, nei koncertas, kai klausytojai taip pat įtraukiami. Profesionalūs muzikantai kuria erdvę, kurioje skleidžiasi mantros ir jų grožis. Kviečiame su šeima šventiškai praleisti popietę.&nbsp;<br />\n	<br />\n	<strong>Agnietė Laurinaitytė</strong> vokalas<br />\n	<strong>Laura Budreckytė</strong> vokalas<br />\n	<strong>Agnietė Ivanauskaitė</strong> fleita<br />\n	<strong>Paulius Volkovas</strong> gitara<br />\n	<strong>Domas Žostautas</strong> bosinė gitara<br />\n	<br />\n	Koncerto metu sėdima ant grindų.<br />\n	<br />\n	<br />\n	<strong>', '2014-12-26 15:00:00', '2014-12-26 00:00:00', '2014-12-08 20:34:42', '(54.6799932, 25.2782295)', NULL),
(14, ' Vilnius ', 'EMIR KUSTURICA & NO SMOKING ORCHESTRA ', '<div style="text-align: justify;">\n	<strong>Į Vilnių sugrįžta kultinis serbų režisierius Emiras Kusturica kartu su „No Smoking Orchestra“</strong><br />\n	<br />\n	2015 m. vasario 25 d. „Compensa“ koncertų salėje savo pašėlusį koncertą surengs garsus serbų režisierius Emiras Kusturica ir kolektyvas „No Smoking Orchestra“. Dažnai spaudoje fenomenaliu vadinamas orkestras kartu su beprotiškai talentingu kino kūrėju priešakyje atliks savo geriausią programą pačių muzikantų išgalvotu „unza unza“ stiliumi. Šis koncertas bus ne tik tikra dovana muzikos gurmanams, bet ir šventė visiems E.Kusturicos filmų gerbėjams, nes koncerte skambės ir puikiai atpažįstamos melodijos iš kino juostų „Morčius, arba katytė juoda, o katinas baltas“, „Gyvenimas kaip stebuklas“ bei kitų.<br />\n	<br />\n	Kiekvienas „Nerūkančio orkestro“&nbsp; pasirodymas pasižymi itin plačiu muzikiniu spektru – koncerto metu čia skamba čigonų folkloras, tautiniai serbų ritmai, modernusis technopop, balkanų pankrokas, italų klasika, turkų maršai, egzotiški Afrikos garsai ir kita muzika. Tačiau ši regis absoliuti muzikinė anarchija scenoje virsta tobulu kinematografišku spektakliu, demonstruojančiu kiekvienam žiūrovui kaip reikia gerti gyvenimą dideliais gurkšniais ir ką iš tikrųjų reiškia žodis linksmintis!<br />\n	<br />\n	<strong>No Smoking Orchestra</strong><br />\n	<br />\n	1980 m.&nbsp; Jugoslavijoje gimusi grupė „Zabranjeno Pušenje“ (anglų kalba – „No Smoking“) trankiais ritmais sukrėtė devintojo dešimtmečio Sarajevą, dabartinės Bosnijos ir Hercegovinos sostinę. Jų plokšteles graibstyte graibstė šimtai tūkstančių gerbėjų. Režisierius Emiras Kusturica su muzikantais susipažino 1981 m. filmuodamas savo debiutinę pilno metro juostą „Ar tu prisimeni Dolly Bell?“ („Do You Remember Dolly Bell?“).<br />\n	<br />\n	Kompanija taip susidraugavo, kad jau 1986 m. Emiras pradėjo groti bosine gitara grupėje ir nufilmavo jiems keletą vaizdo klipų. Vėliau grupė buvo pristabdžiusi savo veiklą, tačiau 1998 m. pasivadina „No Smoking Orchestra“, įrašo garso takelį režisieriaus filmui „Morčius, arba katytė juoda, o katinas baltas“ ir nuo to laiko kuria muziką visiems E.Kusturicos kino darbams. Režisieriaus sūnus Striboras Kusturica jau dvidešimt metų groja būgnais šiame kolektyve, o pats Emiras yra pastovus grupės narys nuo 1999 m. (groja ritmo gitara).<br />\n	<br />\n	Grupė aktyviai koncertuoja visuose kontinentuose ir turi ištikimų gerbėjų būrį kiekvienoje šalyje.<br />\n	<br />\n	Koncertas įvyks 2015 m. vasario 25 d. „Compensa“ koncertų salėje (Kernavės g. 84, Vilnius, priešais PC „Ozas“)</div>\n<br />\n<strong>EMIR KUSTURICA</strong><br />\n<a href="https://www.youtube.com/watch?v=HsCD-tmUiGI" target="_blank">https://www.youtube.com/watch?v=HsCD-tmUiGI</a><br />\n<a href="https://www.youtube.com/watch?v=6b5dNmdRpN8" target="_blank">https://www.youtube.com/watch?v=6b5dNmdRpN8</a><br />\n<a href="https://www.youtube.com/watch?v=p7KO6a_9VeA" target="_blank">https://www.youtube.com/watch?v=p7KO6a_9VeA</a><br />\n<a href="https://www.youtube.com/watch?v=ja6Xg2OgUgU" target="_blank">https://www.youtube.com/watch?v=ja6Xg2OgUgU</a><br />\n<br />\n<br />\n<strong>', '2015-02-25 20:00:00', '2015-02-25 22:00:00', '2014-12-08 20:34:49', '(54.711749, 25.276683)', NULL),
(15, ' Vilnius ', 'YANN TIERSEN ', '<div style="text-align: justify;">\n	<strong>Pirmą kartą Vilniuje – romantiškos „Amelijos iš Monmartro“ kompozitorius Yann Tiersen su grupe</strong><br />\n	<br />\n	2015 m. kovo 7 d. Vilniuje, naujoje „Compensa“ koncertų salėje pirmą kartą Lietuvoje savo koncertą surengs žymus prancūzų kompozitorius, multi-instrumentalistas Yannas Tiersenas su grupe. Talentingas menininkas, kritikų nuolat lyginamas su garsiaisiais kūrėjais Eriku Satie ir Nino Rota, yra įvaldęs fortepijoną, smuiką, akordeoną, akustinę ir elektrinę gitaras, violončelę, klavesiną, vibrafoną, mandoliną, bandžą ir kitus instrumentus. Nors Y.Tierseno diskografijoje - 8 studijiniai ir 3 koncertiniai albumai, tačiau pasaulinį pripažinimą jam pelnė jo sukurtas garso takelis vienam visų laikų sėkmingiausių kino filmui <strong>„Amelija iš Monmartro“</strong>. Koncerte Vilniuje muzikantas pristatys savo naująjį albumą <strong>„Infinity“</strong>, išleistą 2014 m., o taip pat visas populiariausias savo kompozicijas.<br />\n	<br />\n	Yannas Tiersenas gimė 1970 m. Bresto mieste šiaurės vakarų Prancūzijoje, belgų ir norvegų šaknų turinčioje prancūzų šeimoje. Fortepijonu pradėjo skambinti būdamas ketverių, smuiku – šešerių metų amžiaus, o klasikinį išsilavinimą įgijo net keliose muzikos akademijose. Didžiulę įtaką paauglystėje jam turėjo pankų subkultūra ir grupių „The Stooges“ ir „Joy Division“ kūryba. 1983 m. būdamas 13-os, Y.Tiersenas sudaužė savo smuiką, nusipirko elektrinę gitarą ir subūrė roko grupę.<br />\n	<br />\n	Po poros metų šis audringas paauglystės laikotarpis baigėsi, Y.Tierseno grupė iširo, muzikantas įsigijo pigų mikšerinį pultą ir pradėjo kurti foninę muziką teatro pastatymams bei trumpametražiams kino filmams.<br />\n	<br />\n	Pirmosios sėkmės Prancūzijoje menininkas sulaukė 1998 m., išleidęs trečiąjį studijinį albumą „Le Phare“, kurio pardavimai siekė net 160 tūkstančių kopijų. Tuo pat metu Y.Tierseno muzika jau skamba filmuose „La Vie Rêvée des Anges" (1998), „Alice et Martin" (1998) ir „Qui Plume la Lune?" (1999). Kompozitorius tapo Prancūzijos įžymybe, juo žavėjosi laisvieji menininkai, alternatyvioji jaunimo karta ir klasikinės muzikos gerbėjai, dievinantys jo kuriamus valsus.<br />\n	<br />\n	2001 m. Y.Tierseno gyvenimas pasikeitė iš esmės - ekranuose pasirodė <strong>„Amelija iš Monmartro“</strong>, visų mylima romantinė komedija, kuriai talentingas kompozitorius sukūrė visą garso takelį ir kuri pelnė jam pasaulinį pripažinimą. Juostoje skambėjo naujos kompozicijos, o taip pat kūriniai iš pirmų trijų Y.Tierseno albumų. Filmas <strong>„Amelija iš Monmartro“</strong> buvo nominuotas penkiems „Oskarams“, yra pelnęs 55 apdovanojimus ir vadinamas vienu sėkmingiausių visų laikų prancūzišku filmu. Dar vienas žymus menininko darbas – garso takelis vokiečių tragikomedijai <strong>„Viso gero, Leninai!“</strong> <strong>(„Good Bye Lenin!“)</strong>, į ekranus įžengusiai 2003 m., nominuotai „Auksiniam gaubliui“ ir pelniusiai net 32 svarbius kino pasaulyje apdovanojimus.<br />\n	<br />\n	<strong>Įdomesni faktai:</strong><br />\n	• „Amelijos iš Monmartro“ garso takelio klausytojų kiekis Youtube portale skaičiuojamas dešimtimis milijonų kartų;<br />\n	• Kasmet „Google“ interneto paieškos svetainėje Yanno Tierseno vardą įveda daugiau kaip 5 mln. žmonių;<br />\n	• Po „Amelijos“ parodymo Japonijoje ir kitose Rytų šalyse, tėvai pradėjo vadinti naujagimius Y.Tierseno dainų pavadinimais;<br />\n	• 90% žmonių turi muzikanto įrašus savo kolekcijose, bet nežino, kad jų autorius yra Y. Tiersenas;<br />\n	• Pastaruoju metu Y.Tiersenas intensyviai koncertuoja, pristatydamas savo naujajį albumą „Infinity“. Ir beveik visi jo koncertai – anšlaginiai, į kuriuos bilietai išperkami vos per 5 minutes!<br />\n	<br />\n	Koncertas įvyks 2015 m. kovo 7 d. „Compensa“ koncertų salėje (Kernavės g. 84, Vilnius, priešais PC „Ozas“)<br />\n	<br />\n	<strong>YANN TIERSEN</strong><br />\n	<a href="https://www.youtube.com/watch?v=O8ACZ6IyyqM" target="_blank">https://www.youtube.com/watch?v=O8ACZ6IyyqM</a><br />\n	<a href="https://www.youtube.com/watch?v=9vopaDE_9aE" target="_blank">https://www.youtube.com/watch?v=9vopaDE_9aE</a><br />\n	<a href="https://www.youtube.com/watch?v=duGbgrv9LRE" target="_blank">https://www.youtube.com/watch?v=duGbgrv9LRE</a><br />\n	<a href="https://www.youtube.com/watch?v=gKqHjFtX7iE" target="_blank">https://www.youtube.com/watch?v=gKqHjFtX7iE</a><br />\n	<a href="https://www.youtube.com/watch?v=m4kRciR7Eo4" target="_blank">https://www.youtube.com/watch?v=m4kRciR7Eo4</a><br />\n	<br />\n	&nbsp;</div>\n<strong>', '2015-03-07 19:00:00', '2015-03-07 20:30:00', '2014-12-08 20:34:54', '(54.711749, 25.276683)', NULL),
(16, ' Šiauliai ', '''''Omnis una gaudeamus'''' berniukų ir jaunuolių choro ''''Dagilėlis'''' koncertas ', '<div style="text-align: justify;">\n	ŠIAULIŲ BERNIUKŲ IR JAUNUOLIŲ CHORAS „DAGILĖLIS“ (meno vadovas ir dirigentas Remigijus Adomaitis)<br />\n	<br />\n	Šiaulių berniukų ir jaunuolių choras „Dagilėlis“, 1990m. įkurtas Remigjaus Adomaičio, praplėtė berniukų chorų tradicijas ir yra vienas ryškiausių šio žanro kolektyvų Lietuvoje. Kasmet surengia per penkiasdešimt koncertų Lietuvoje bei užsienyje. „Dagilėlio“&nbsp; balsai skambėjo žymiausiose JAV, Italijos, Kinijos, Jungtinės Karalystės, Vokietijos, Ispanijos, Prancūzijos, Čekijos, Rusijos, Baltarusijos, Latvijos, Lenkijos, Slovėnijos, Estijos ir kitų Europos šalių koncertų salėse. Choras nuolat bendradarbiauja su Lietuvos ir užsienio meno kolektyvais. „Dagilėlis“ koncertavo su Sankt Peterburgo valstybiniu Ermitažo orkestru „Camerata Sankt Peterburg“, Minsko, Kaliningrado, Lietuvos, šv.Kristoforo, Klaipėdos bei Šiaulių kameriniais orkestrais, Lietuvos valstybiniu simfoniniu orkestru, styginių kvartetu Art Vio, S.Šiaučiulio džiazo kvartetu. Choro ir jo vadovo indėlis į kultūrinį Lietuvos gyvenimą įvertintas LR Prezidentų Padėkos raštais, diplomais, „Aukso paukšte“, specialiuoju prizu už Lietuvos dainų švenčių tradicijų puoselėjimą. „Dagilėlis“ nuolat dalyvauja tarptautiniuose ir Lietuvos festivaliuose, yra įvairių tarptautinių chorų konkursų nugalėtoju:<br />\n	I vieta tarptautiniame vaikų ir jaunimo chorų konkurse Gießen (1997 m., Vokietija),<br />\n	I premija ir aukso medalis konkurse „Guido d‘Arezzo“ Arezzo (1999 m., Italija),<br />\n	I vieta „Music World“&nbsp; Fivizzano (2000 m. Italija),<br />\n	I vieta tarptautiniame advento muzikos konkurse Prahoje (2002 m., Čekija),<br />\n	I vieta tarptautiniame Valentino Bucchi konkurse Romoje (2004 m. Italija),<br />\n	GRAND PRIX ir du aukso medaliai tarptautiniame chorų konkurse Olomouc (2006 m., Čekija),<br />\n	GRAND PRIX&nbsp; ir pirma premija tarptautiniame sakralinės muzikos konkurse Kaune (2007, Lietuva),<br />\n	I vieta tarptautiniame chorų konkurse „Giuseppe Zelioli“ Lecco (2010 m., Italija).<br />\n	I vieta III tarptautiniame chorų festivalyje - konkurse „Vratislavia Sacra“ Vroclave (2013m., Lenkija)<br />\n	I vieta ir aukso apdovanojimas tarptautiniame chorų festivalyje – konkurse Pekine (2014m., Kinija)<br />\n	<br />\n	<br />\n	<strong>', '2014-12-17 18:00:00', '2014-12-17 19:30:00', '2014-12-08 20:35:00', '(55.9301357, 23.3128603)', NULL),
(17, ' Šiauliai ', 'Saulės Šerytės ir Donaldo Račio koncertas ', '<div style="text-align: justify;">\n	M. K. Čirlionio menų gimnazijos absolventė, mecosopranas <strong>Saulė Šerytė</strong> solinio dainavimo studijas pradėjo LMTA, jas pratęsė ir magistro laipsniu baigė Graco Meno Universitete ( Austrija).<br />\n	Stažavo meistriškumo kursuose: Nyderlanduose pas&nbsp; („Holland Music Session“, prof.&nbsp; Elly Ameling, prof. Daniel Ferro 1993/1996), Italijoje („Daniel Ferro Vocal Program“, 1996/1999), Slovėnijoje (Tarptautinė dainavimo mokykla&nbsp;&nbsp; „Hugo Wolf dainų interpretacija“, prof. Breda Zakotnik, 2000/2002), Sablé Baroko muzikos akademijos rengiamuose kursuose Čekijoje (Praha, 2011) ir Prancūzijoje (Sablé, 2011).<br />\n	Konkurso „Wagner forum Graz“ (Austrija) specialiosios premijos laureatė (1996) ir&nbsp; „Tiito Kuusiko tarptautinio&nbsp; kamerinės muzikos konkurso“ („Tiit Kuusik International Lied Competition“) (Estija) laureatė.<br />\n	Koncertavo su Lietuvos kameriniu, Šv. Kristoforo kameriniu, Baltarusijos valstybiniu kameriniu orkestrais (diriguojant Sauliui Sondeckiui, Vaclovui Augustinui, Justus Franz, Rolf Beck), senosios muzikos programas atliko su kameriniu ansambliu „Musica humana“, chorais „Jauna muzika“ ir „Aidija“, senosios muzikos ansamliais „Duo barocco“, „Affectus“, „Concertino delle donne“ ir tarptautiniu senosios muzikos ansambliu „Canto fiorito“.<br />\n	Nuo 2010 m. Saulė Šerytė yra LMTA meno doktorantė, tyrinėja baroko vokalinę muziką, dalyvauja konferencijose, rengia publikacijas.<br />\n	Su pianistu Donaldu Račiu solistė yra paruošusi ne vieną&nbsp; Lied žanro kūrinių programą.<br />\n	<br />\n	<strong>Donaldas Račys</strong> gimė 1968 m. Šiauliuose, kur ir pradėjo mokytis groti fortepijonu. Mokslus tęsė M. K. Čiurlionio menų mokykloje (mok. E. M. Šernienės ir A. Jurgelionio klasėse). Dar būdamas moksleivis, Donaldas tapo daugelio respublikinių, tarprespublikinių ir tarptautinių konkursų laureatu. 1987‒1993 Donaldas studijavo Maskvos P. Čaikovskio valstybinėje konservatorijoje, kur sėmėsi žinių iš prof. V. Kastelskyj bei prof. L. Diedovos. Magistro studijas baigė Vilniuje, Lietuvos Muzikos akademijoje, prof. P. Geniušo klasėje.<br />\n	Pianistas ne kartą koncertavo Vokietijos, Italijos, Danijos, Rusijos klausytojams, su Lietuvos kameriniu orkestru darė įrašus Lietuvos radijui. Solinės ir kamerinės muzikos atlikėjas dažnai koncertuoja su ilgalaikiais scenos partneriais: smuikininku Andriumi Gudaičiu ir dainininke Saule Šeryte.<br />\n	D. Račys dažnai veda fortepijono meistriškumo pamokas, yra kviečiamas būti respublikinių ir tarptautinių konkursų žiuri nariu.<br />\n	Šiuo metu dirba M. K. Čiurlionio menų mokykloje ir Vytauto Didžiojo universiteto Muzikos akademijoje.<br />\n	<br />\n	<br />\n	<strong>', '2014-12-11 18:00:00', '2014-12-11 19:30:00', '2014-12-08 20:35:05', '(55.934301, 23.3146759)', NULL),
(18, ' Šiauliai ', 'Rebelheart albumo ''''Mysteria'''' pristatymas. Koncerto svečias Arina ', '<div style="text-align: justify;">\n	<br />\n	<br />\n	1992 02 29 diena. Ši paslaptinga ir įdomi diena subūrė 4 žmones į vieną branduolį, kurį jie pavadino "Rebel Heart". Grupės sudėtis nepakito nuo pat pirmosios dienos.<br />\n	Nuo 1994 metų kiekvienais metais grupė buvo nominuojama prestižiškiausiuose Lietuvos<br />\n	muzikiniuose apdovanojimuose ir tris kartus buvo pripažinta geriausia Lietuvos roko grupe.<br />\n	9 CD, 7 video klipai, 1994 metais nufilmuoti du tikro garso koncertai LNK televizijoje. 2008- Lietuvos Ryto televizijoje.<br />\n	10-ojo jubiliejinio, akustiškai įrašyto albumo „Mysteria“ pristatymas jau gruodžio 29d. koncertų salėje „Saulė“ Šiauliuose.<br />\n	Daugiau nei dviejų valandų trukmės koncerte skambės ne tik naujojo albumo dainos, speciali koncerto svečio programa, bet ir iki skausmo pažįstamos „Ilgas kelias“, Juodas lietus“, "Ar išsaugosi mano meilę" ir kt. dainos<br />\n	Specialus koncerto svečias Lietuvos bliuzo karalienė – Arina.<br />\n	<br />\n	&nbsp;</div>\n<strong>', '2014-12-29 18:00:00', '2014-12-29 20:00:00', '2014-12-08 20:35:10', '(55.9301357, 23.3128603)', NULL),
(19, ' Vilnius ', 'Naujametis koncertas ''''Lito palydos'''' su ansambliu ''''Lietuva'''' ir humoriste Violeta Mičiuliene ', '<div style="text-align: justify;">\n	<strong>Humoristinės lito palydėtuvės su ansambliu „Lietuva“</strong><br />\n	<br />\n	Į trankias metų palydėtuves ir humoristinį atsisveikinimą su Lietuvos nacionaline valiuta Litu vilniečius bei miesto svečius kviečia ansamblis „Lietuva“ su humoriste Violeta Mačiuliene.<br />\n	<br />\n	„Simboliška, kad Lietuvai atsisveikinant su Litu jį išlydi ansamblis „Lietuva“. Šiame permainingame laikotarpyje norisi alsuoti optimizmu ir nuo kalno stačia galva šokant žemyn sakyti „skrendam“, o ne „krentam,“ - sako humoristė V. Mičiulienė. „Todėl senuosius nusprendėme palydėti į viską žvelgiant su šypsena. Svarbu tikėti ir matyti šviesą tunelio gale, net jeigu ji sklinda nuo švieslentės, ant kurios parašyta „Išėjimo nėra“, - dalinasi mintimis populiari Lietuvos humoristė.<br />\n	<br />\n	Paskutinę šių metų dieną valstybinio dainų ir šokių ansamblio „Lietuva“ gerbėjų laukia netradicinė – humoristinė programa „Lito palydos“, kurioje žiūrovai išvys kiek kitokį – šaržuotą ansamblio veidą. Populiariausios melodijos, smagiausios ansamblio dainos ir šokiai, autentiški margaspalviai kostiumai nuskaidrins savo gaivališka energija bet kokio amžiaus žiūrovus. Koncerto programa turtinga žanrų žaisme, tematikos bei nuotaikų įvairove - nuo lyriškų, širdį glostančių liaudies melodijų iki trankių, kaimiškas „uliavones“ vaizduojančių dainų ir šokių. O kad juoko ir geros nuotaikos pakaktų visiems ateinantiems metams, humoristė Violeta Mičiulienė žada žiūrovams pateikti ne vieną staigmeną. Na ir žinoma, kokios gi Naujųjų išvakarės be žymiosios „Užstalės dainos“ iš operos „Traviata“? Tad laukiami visi, kurie Naujuosius nori pasitikti nusiprausę juoko ašaromis ir įkvėpti neblėstančia ansamblio „Lietuva“ dvasia.&nbsp;<br />\n	<br />\n	Naujametis koncertas „Lito palydos“ vyks gruodžio 31 d., 18 val. Lietuvos vaikų ir jaunimo centro Didžiojoje salėje (Konstitucijos pr . 25, Vilnius).<br />\n	<br />\n	<br />\n	<strong>', '2014-12-31 18:00:00', '2014-12-31 00:00:00', '2014-12-08 20:35:26', '(54.6988175, 25.2676381)', NULL),
(20, ' Vilnius ', 'Vilnius Jazz 2015 ', '<div style="text-align: justify;">\n	<strong>„Vilnius Jazz“</strong> – seniausias kasmetinis Vilniaus džiazo festivalis, organizuojamas nuo 1987 m. Tai vienintelis renginys Lietuvoje, kurio programose pagrindinis dėmesys skiriamas įvairiausioms šiuolaikinio džiazo atmainoms.<br />\n	<strong>„Vilnius Jazz“ </strong>būdingas tam tikras radikalumas, ryški orientacija į naujoves. Greta džiazo ir laisvosios improvizacinės muzikos atlikėjų festivalio stilistines ribas yra ne kartą praplėtę akademinės, etninės, roko, industrinės muzikos atstovai.<br />\n	<br />\n	Siekdamas supažindinti Lietuvos džiazo mėgėjus su aktualiausiomis šiuolaikinio džiazo tendencijomis, festivalis kasmet ieško naujų, kylančių vardų ir sukviečia įdomiausius nūdienos džiazo muzikantus iš viso pasaulio.<br />\n	<br />\n	Festivalio inicijuojamuose projektuose šalia pripažintų Lietuvos džiazo meistrų dalyvauja ir jaunoji atlikėjų karta, kuriems „Vilnius Jazz“ scena neretai tampa atsparos tašku sėkmingiems pasirodymams tarptautiniuose projektuose ir kituose Europos džiazo festivaliuose. „Vilnius Jazz“ vardas neatsiejamas nuo Vilniaus džiazo mokyklos raidos. Festivalis pripažįstamas vienu svarbiausių Rytų Europos džiazo židinių, kuriame puoselėjamos ir skleidžiamos gyvybingos improvizacinės muzikos tradicijos.<br />\n	<br />\n	<strong>Vilnius Jazz 2015 festivalio abonementai galioja į visus festivalio koncertus, vykstančius Rusų dramos teatre.</strong><br />\n	<br />\n	<br />\n	<strong>', '2015-10-15 00:00:00', '2015-10-18 00:00:00', '2014-12-08 20:35:37', '(54.681081, 25.273093)', NULL),
(21, ' Vilnius ', 'Kalėdinė muzikinė pasaka vaikams MAULIUKAS ', '<div style="text-align: justify;">\n	<strong>Kalėdinė muzikinė pasaka vaikams „Mauliukas“</strong><br />\n	<br />\n	Lietuvos vaikų poeto Martyno Vainilaičio eiliuotos mitologinės pasakos motyvais<br />\n	Scenarijaus autorius ir režisierius - Žilvinas Ramanauskas<br />\n	Kompozitorė - Indrė Stakvilevičiūtė-Ehrhard<br />\n	<br />\n	<strong>Spektaklyje dalyvauja:</strong><br />\n	Doras angelas Mauliukas, jo mylima mergaitė Nastutė, visagalis Dievas, kerštingas Liucijus, Mukis, Ponas, Kaukutis, Dėdė ir visas būrys angelų, velnių ir kitų spalvingų personažų ir ansamblio „Lietuva“ šokėjai, choro artistai ir liaudies instrumentų orkestras!<br />\n	<br />\n	<strong>Trumpa siužeto santrauka:</strong><br />\n	Danguje - kaip Rojuje. Dievas kuria, angeliukas Mauliukas miežia jam dažus, o angelų dirigentas Mukis mėgaujasi savo darbu ir savimi, todėl netrukus jam ir jo pakalikams ima augti ragai, atsiranda kanopos ir galų gale jie nugarma į pelkes ir dar giliau. Taigi pragare Mauliukas, ruošiamas būti tikru velniu ir gauna rimtą užduotį: parnešti dievobaimingo valstiečio sielą. Mauliukas pasirenka klasikinį kelią - sielą gauti už pinigus. Stebime įspūdingą, kūrybiško velniuko ir tikrai doro žmogelio bendravimą, kuris perauga į bendradarbiavimą ir net draugystę. Pragaro vadovybė nerimsta - reikalauja&nbsp; žadėtos vėlės, tačiau kai Mauliukas staiga įsimyli valstiečio dukterėčią Nastutę ir pragaro užduotis pamiršta - Liucijus nejuokais užpyksta, gąsdina Mauliuką, o Nastutę pražudo. Liūdėdamas dėl mylimosios Mauliukas nustoja būti velniuku ir jame nubunda žmogiško keršto jausmas. Kartu su valstiečiu jie išsiruošia į žygį prieš velnius. Po nelengvos kovos gėris nugali blogį.<br />\n	<br />\n	<strong>Spektaklis vyks gruodžio 20 d. (šeštadienį) 12 val. ansamblio „Lietuva“ patalpose</strong> (Vytenio g. 50, kampas su Panerių g., įėjimas iš Panerių gatvės, priešais „Švaros brolius“)<br />\n	<br />\n	<br />\n	<strong>', '2014-12-20 12:00:00', '2014-12-20 00:00:00', '2014-12-08 20:35:42', '(54.6710419, 25.26705)', NULL),
(22, ' Šiauliai ', 'Vitalijos Katunskytės ir draugų kalėdinis koncertas ', '<strong>Vitalija Katunskytė kviečia į šventinį Kalėdinį koncertą koncertų salėje "Saulė".</strong><br />\n<br />\nKoncertas įvyks 2014-12-19 18:00<br />\n<br />\n<u>Koncerte dalyvauja:</u><br />\nRadži<br />\nKlaipėdos parodijos teatras<br />\nPramoginių šokių virtuozai Mindaugas ir Viltė<br />\nKauno vaikų choras "Lašeliukai"<br />\nVitalijos dukra Monika<br />\nSaksafonistas Remigijus Kraptavičius<br />\nir žinoma pati Vitalija Katunskytė su nauja programa!<br />\n<br />\n<strong>', '2014-12-19 18:00:00', '2014-12-19 20:00:00', '2014-12-08 20:35:48', '(55.9301357, 23.3128603)', NULL),
(23, ' Šiauliai ', 'Vaidas Baumila. Albumo ''''Iš naujo'''' pristatymo koncertas ', '<div style="text-align: justify;">\n	Vaido Baumilos albumo „Iš naujo“ pristatymo koncertas<br />\n	<br />\n	2014 m. spalį pirmąjį gyvo garso turą po Lietuvą „Coming Home“ surengęs atlikėjas Vaidas Baumila kviečia į naujo savo albumo pristatymo koncertus.<br />\n	<br />\n	Abejingų nepalikęs turas „Coming Home“, kuriame skambėjo naujai aranžuotos žinomiausios atlikėjo dainos bei naujausi jo kūriniai, sulaukė didelio pasisekimo – į koncertus didžiuosiuose Lietuvos netilpo visi, norėję pasiklausyti Vaido. Tačiau dainininkas čia sustoti nesiruošia. „Šis turas buvo labai geras apšilimas, – teigia atlikėjas. – Pamatėme, kurias iš senų dainų klausytojai labiausiai mėgsta, pirmą kartą atlikome naujausius kūrinius. Tačiau su komanda turime didesnių planų. Trumpam išeiname kūrybinių atostogų ir grįšime su naujausiu savo darbu – albumu „Iš naujo“ bei jo pristatymo koncertais.“<br />\n	<br />\n	.Naujajame albume klausytojai ras ne tik naujas Vaido dainas, bet ir keletą jau pristatytų ir visų pamėgtų, tačiau jokiame albume dar nepublikuotų kūrinių, tokių kaip „Ieškok manęs“, „Mergaitė“, „Free Love“ ar „Dying“. Iki albumo „Iš naujo“ pristatymo Vaidas žada išleisti dar keletą būsimojo rinkinio dainų.<br />\n	<br />\n	Vaidas akcentuoja, kad, kalbant apie bendrą albumo skambesį bei pristatymo koncertus, jam svarbiausia turinys, o ne „blizgučiai“. „Keliaudamas ir dirbdamas užsienyje įgavau tikrai daug patirties, – teigia dainininkas. – Ateina laikas, kai tampa labai aišku, kas koncerte svarbiausia. Man tai kokybiška muzika ir profesionalus techninis koncerto pateikimas – tinkamas įgarsinimas bei apšvietimas. Kartu su komanda siekiame, kad koncertai būtų tikri, brandūs ir nuoširdūs.“<br />\n	<br />\n	Vaido Baumilos albumo „Iš naujo“ koncertas Šiauliuose – jau kovo 21 d., koncertų salėje „Saulė“.&nbsp; Bilietai brangs!<br />\n	<br />\n	<br />\n	<strong>', '2015-03-21 19:00:00', '2015-03-21 20:30:00', '2014-12-08 20:35:58', '(55.9301357, 23.3128603)', NULL),
(24, ' Vilnius ', 'Šeimadienis. Šeimos festivalis ', '<div style="text-align: justify;">\n	Praėjus švenčių šurmuliui, kviečiame skirti laiko sau, savo šeimai, tam, kas svarbu. Atvykite į pirmą kartą Vilniaus arkivyskupijoje organizuojamą ŠEIMADIENĮ, kuriame atrasite, ko nežinojote, ar prisiminsite tai, ką buvote pamiršę.<br />\n	<br />\n	Laukiami visi, kuriems rūpi šeima! Gilinkite žinias, atraskite erdvę prasmingai veiklai. Švęskime ŠEIMADIENĮ drauge!<br />\n	<br />\n	Kada? 2015 m. sausio 10 d., šeštadienį, 11–20 val.<br />\n	Kur? Vilniuje, Lietuvos parodų ir kongresų centre LITEXPO, Laisvės pr. 5, Vilnius<br />\n	<br />\n	Šeimos festivalyje Jūsų laukia:<br />\n	<strong>11.00–17.00 val. Expo</strong> – įvairių veiklų Bažnyčioje pristatymas;<br />\n	<strong>11.30–16.30 val.</strong> <strong>pranešimai</strong> aktualiomis temomis;<br />\n	<strong>17.00–18.15 val. šv. Mišios;</strong><br />\n	<strong>18.30–20.00 val. koncertas:</strong> Linas Adomaitis, Evelina Sašenko, Vaidas Baumila, Girmantė Vaitkutė, Berta Timinskaitė, Urbanistinio šokio teatras „Low Air“ ir kiti atlikėjai.<br />\n	Vakaro svečias – dainininkas Daniel diSilva (JAV) su Gospel komanda „HARK!“<br />\n	<br />\n	Taip pat renginyje:<br />\n	• susitikimai su įvairių bendruomenių atstovais;<br />\n	• diskusijos tikėjimo ir šeimos gyvenimo temomis;<br />\n	• vaikų zona su kūrybiniais užsiėmimais;<br />\n	• kino filmas ir diskusija paaugliams su kino kritiku Ramūnu Aušrotu ir TV laidų vedėju, komiku Rimu Šapausku;<br />\n	• pokalbiai su dvasininkais;<br />\n	• „Carito“ Gailestingumo kavinė.<br />\n	<br />\n	Susirinkusieji bus kviečiami klausytis PRANEŠIMŲ aktualiomis šeimoms ir šeimų nariams temomis.<br />\n	• Kaip atrasti džiaugsmą šeimoje? - Tarptautinės šeimų vystymosi federacijos IFFD generalinis sekretorius, teisininkas, septynių vaikų tėvas Javier VIDAL-QUADRAS (Ispanija)<br />\n	• Ar sutuoktinių rūpinimasis vienas kitu padeda ugdyti vaikus? - Kun. prof. hab. dr. Adam SKRECZKO (Lenkija)<br />\n	• Ar seksas būna dvasingas? - Muzikantas, tarptautinis kalbėtojas Daniel DISILVA (JAV)<br />\n	• Ar įmanoma nuolat atleisti? - Kun. Antanas SAULAITIS SJ<br />\n	• Ką moteriai reiškia būti sukurtai panašiai į Dievą? - S. Ligita RYLIŠKYTĖ SJE<br />\n	• Nevaisingumo iššūkiai šeimai ir vaisingumo dovana - Teologas dr. Benas ULEVIČIUS<br />\n	• Tikras vyriškumas: alus ir prakaitas ar kojų depiliacija ir cigarilės? - Antropologas Saulius MATULEVIČIUS<br />\n	• Skyrybų skausmą įveikiant - Sielovadininkė Elvyra KUČINSKAITĖ<br />\n	• „Tuščias lizdas“ ar antroji jaunystė? - Dr. Nijolė LIOBIKIENĖ<br />\n	• Ar tave vis dar myliu arba Ką gi man mylėti tavyje? - Kun. Ričardas DOVEIKA<br />\n	<br />\n	Atradimo skonį kviečiame patirti EXPO.<br />\n	Čia sužinosite apie prasmingos veiklos galimybes švietimo ir ugdymo srityse; kur ir kaip teikiama socialinė ir dvasinė pagalba, kuo naudingi Jaunimo, Šeimos ir kiti centrai, kur vyskupijoje kviečiame apsilankyti, ką veikia įvairios bendruomenės, kas vyksta parapijose.<br />\n	<br />\n	<br />\n	Pasižymėkite savo kalendoriuje ŠEIMADIENĮ!<br />\n	<br />\n	<a href="http://www.seimadienis.lt" target="_blank">www.seimadienis.lt</a><br />\n	<br />\n	<br />\n	<strong>', '2015-01-10 11:00:00', '2015-01-10 20:00:00', '2014-12-08 20:36:04', '(54.678884, 25.2239599)', NULL),
(25, ' Latvija ', 'Līvu vandens parkas. Kalėdų dovanų kortelė ', 'Dovanų kortelė skira vienam asmeniui. Galioja visą dieną.<br />\nDovanų kortelė gali būti panaudota nuo 2014 12 24 iki 2015 05 24.<br />\n<br />\n<br />\n<strong>Renginio organizatorius:</strong> Akvaparks SIA<br />\n<br />\n', '2015-01-15 23:00:00', '2015-01-15 00:00:00', '2014-12-08 20:36:14', '(56.975398, 23.860515)', NULL),
(26, ' Šiauliai ', 'Didysis Kalėdinis koncertas 2014 ', '<div style="text-align: justify;">\n	Jau penktus metus iš eilės, koncertinė įstaiga “Saulė” organizuoja didįjį Kalėdinį koncertą. Koncerto metu, pritariant Šiaulių simfoniniam orkestrui, skambės populiarios arijos iš operų , kurias atliks Lilija Gubaidulina (sopranas), Mindaugas Zimkus (tenoras) ir buvęs šiaulietis Egidijus Dauskurdis (bosas).<br />\n	<br />\n	Dainavimas yra mano gyvenimas“ – sako<strong> Lilija Gubaidulina</strong>, pernai metais apdovanota Auksinio balso titulu LRT konkurse „Triumfo arka. Solistė yra baigusi Kazanės konservatoriją. Čia ji pradėjo dainininkės karjerą ir jau tuomet parengė pluoštą operos vaidmenų: Džilda (G. Verdi „Rigoletas“), Rozina (G. Rossini „Sevilijos kirpėjas“), Marta (N. Rimskis – Korsakovas „Caro sužadėtinė“), Leila (G. Bizet „Perlų žvejai“). L. Gubaidulina yra XVIII Tarptautinio Michailo Glinkos konkurso laureatė (1999 m.), kelių kitų tarptautinių vokalistų konkursų dalyvė bei prizinių vietų laimėtoja.<br />\n	<br />\n	Atvykusi gyventi į kraštą, per beveik 2000 km. nutolusį nuo gimtinės, Lilija įgijo ją pamilusią auditoriją ir plačiai koncertuoja įvairiose Lietuvos bei užsienio koncertų salėse, dalyvauja festivaliuose. Neseniai Kauno muzikiniame teatre solistė atliko Magdalenos vaidmenį U. Giordano operoje „Andrė Šenjė“.<br />\n	<br />\n	<strong>Mindaugas Zimkus</strong><br />\n	Gimė 1970 11 19 Kaune.1977-1984m.mokėsi Kauno J.Naujalio vidurinėje meno mokykloje fortepijono specialybėje pas mokytoją R.Galinytę-Kėvišienę.1984-1989m.Kauno J.Gruodžio aukštesniojoje muzikos mokykloje pas dėstytoją L.Januškienę tęsė choro dirigavimo mokslus .1989-1994m.studijavo LMA Kauno fakultete chorvedybą pas prof. P.Bingelį.Nuo 1989m.iki1998m.dainavo Kauno Valstybiniame Chore.1998m.įstojo į LMTA ir 2003 m baigė Lietuvos muzikos akademijos prof. Virgilijaus Noreikos solinio dainavimo magistro studijas .2003-2005m. Stažavosi LNOBT operos studijoje.<br />\n	<br />\n	2004 m grafo Almavivos vaidmenyje Rossini operoje “ Sevilijos kirpėjas “ debiutavo Lietuvos Nacionaliniame Operos ir Baleto teatre. 2002 m vasaros akademijoje “ Opera Island Bornholm “ Danijoje paruoštą Ferrando vaidmenį W.A. Mozarto operoje “ Cosi fan tutte “ atliko Stokholmo ir Wolfego operos teatrų scenose. Šiuos ir kitus vaidmenis šiuo metu atlieka LNOBT , Kauno ir Klaipėdos muzikiniuose teatruose,Vilniaus“Domino“teatre,Vilniaus mažajame teatre. M Zimkus nemažai koncertuoja įvairiose Lietuvos ir užsienio koncertų salėse. Jo repertuare J.S.Bach‘o , G.F.Hendell‘oW.A.Mozart‘o ,L.van Beethoven‘o mišios ir oratorijos .Artima ir I.Stravinsky‘o , C. Orff‘o , S. Prokofjev‘o , B. Britten‘o , V.Bartulio modernioji muzika. Kamerinės muzikos srityje yra paruošęs ir atlikęs ne vieną kūrinių ciklą .Tai ir F. Schubert‘o vokaliniai ciklai “ Gražioji malūnininkė “ , “ Gulbės giesmė “ ,R.Schumann‘o vokalinis ciklas “Poeto meilė“ , B.Britten‘o vokalinis ciklas “ Septyni Michelangelo sonetai “ , G.Kuprevičiaus vokalinis ciklas styginių kvartetui ir balsui „Vienadienės Tėvynės dainos“<br />\n	<br />\n	Dainininkas yra keleto konkursų nugalėtojas: B.Grincevičiūtės kamerinės muzikos konkursas, 2-oji vieta(2001); S.Baro vyrų balsų konkuras,Grand Prix (2001) ;Vilniaus Tarptautinio dainininkų ir pianistų koncertmeisterių konkursas,3-oji vieta(2005) Tarptautinis Jyvaskule tenorų konkursas,diplomas ( 2002 ) ; Kaliningrado tarptautinis kamerinės muzikoskonkursas,diplomas (2002) .Auksinio scenos Kryžiaus nominantas(2008ir2013);“Fortūnos“diplomantas(2008); geriausias KVMT solistas(2009). Nuo 2006m.yra Kauno Valstybinio Muzikinio Teatro solistas;LTV konkurso“Triumfo Arka 2010“ Auksinio balso“laureatas(II premija) Tarptautinis kamerinio dainavimo konkursas „BEATRIČĖ“ Grand Prix(2011)<br />\n	<br />\n	Sukurti sceniniai vaidmenys:<br />\n	<br />\n	1. Edgardas-G.Donizetti operoje „Lucia di Lammermoor“(KVMT 2011m.)<br />\n	2. Faustas-Ch.Gounod operoje“Faust“(Margarita) (KVMT 2011m.)<br />\n	3. Romeo-Ch.Gounod operoje“Romeo et Juliet“(KVMT 2009m.)<br />\n	4. Alfredas-G.Verdi operoje“La Traviata“(LMTA operos studija<br />\n	5. 2004m.,Klapėdos MT 2004m.,KVMT 2005m.)<br />\n	6. Werteris-J.Massenet operoje“Werther“(Irkutsko tarpt.operos fest. 2014m.)<br />\n	7. Ferrando-W.A.Mozart‘o operoje“Cosi fan tutte“(Rhone muzikinis teatras DK 2002m.)<br />\n	<br />\n	<strong>Egidijus Dauskurdis</strong><br />\n	Egidijus Dauskurdis dainavimo mokėsi Lietuvos muzikos ir teatro akademijoje, Vytauto Juozapaičio klasėje (baigė 2003 m.). Lietuvos muzikos ir teatro akademijos operos studijoje dainavo Figarą W. A. Mozarto operoje „Figaro vedybos“ ir Karalių S. Prokofjevo operoje „Meilė trims apelsinams“. 2001 m. debiutavo LNOBT Šventiko vaidmeniu K. Weilio spektaklyje „Septynios mirtinos nuodėmės“, LNOBT solistas – nuo&nbsp; 2003 m. Bendradarbiauja su Klaipėdos muzikiniu teatru (Falstafas O. Nicolai operoje „Vindzoro šmaikštuolės“, Sparafučilė G. Verdi operoje „Rigoletas“).<br />\n	<br />\n	2002 m. tapo Stasio Baro dainininkų konkurso laureatu. 2005 m. pripažintas „Operos švyturių“ nominacijos „Metų operos viltis“ laureatu.<br />\n	<br />\n	Egidijus Dauskurdis taip pat atlieka stambius vokalinius simfoninius kūrinius, jo repertuare W. A. Mozarto „Coronation Mass “, Requiem,&nbsp; J. Haydno „St. Nicholas Mass“, F. Schuberto Mišios C-dur, S. Moniuszko „Litanie Ostrobramskie“, A. Dvorako&nbsp; Stabat Mater , H. Berliozo&nbsp; „Fausto pasmerkimas“ ir kt.<br />\n	<br />\n	Įrašė kompaktinę plokštelę – G. Fauré Requiem.<br />\n	<br />\n	2004 m.&nbsp; dalyvavo Opera Island vasaros akademijoje Kristiansande, Norvegijoje, kur dainavo Daktarą Grenvilį G. Verdi operoje „Traviata“ (pastatymas Jonathan Miller, dirigentas Marc Soustrot).<br />\n	<br />\n	Gastroliavo Didžiojoje Britanijoje, LNOBT gastrolėse Notingamo teatre&nbsp; dainavo Leporelą.<br />\n	<br />\n	Sukurti vaidmenys:<br />\n	Figaras (W. A. Mozart&nbsp; „Figaro vedybos“)<br />\n	Karalius (S. Prokofjev „Meilė trims apelsinams“)<br />\n	Grafas Tyzenhauzas (B. Dvarionas „Dalia“)<br />\n	Seniūnas, Chirurgas (G. Verdi „Likimo galia“)<br />\n	Boso partija (J. S. Bach „Pasija pagal Joną“)<br />\n	Surinas (P.Čaikovskij „Pikų dama“)<br />\n	Leporelas (W. A. Mozart „Don Žuanas“)<br />\n	Samuelis (G. Verdi&nbsp; „Kaukių balius“)<br />\n	Sparafučilė (G. Verdi&nbsp; „Rigoletas“)<br />\n	Dalandas (R. Wagner „Skrajojantis olandas“)<br />\n	Cuniga (G. Bizet „Karmen“)<br />\n	Falstafas (O. Nicolai „Vindzoro šmaikštuolės“)<br />\n	Daktaras Grenvilis (G. Verdi „Traviata“)<br />\n	Bonza (G. Puccini „Madam Baterflai“)<br />\n	(F. Lehar „Linksmoji našlė“)<br />\n	Šventikas (W. A. Mozart „Užburtoji fleita“)<br />\n	Varlamas (M. Musorgskij „Borisas Godunovas“)<br />\n	Falstafas (O. Nicolai „Vindzoro šmaikštuolės“)<br />\n	Smirnovas (W. Walton „Meška“)<br />\n	Judas, Nazarėnas (R.Strauss „Salomėja“)<br />\n	Dulkamara (G.Donizetti „Meilės eliksyras“)<br />\n	Handingas (R.Wagner „Valkirija“)<br />\n	Lodovikas (G. Verdi „Otelas“)<br />\n	Martinas, Inkvizitorius, Teisėjas, Caras (L. Bernstein „Kandidas”)<br />\n	Greminas (P. Čaikovskij „Eugenijus Oneginas”)<br />\n	Frankas (J.Strauss „Šikšnosparnis”) ir kt.<br />\n	<br />\n	<br />\n	<strong>', '2014-12-18 18:00:00', '2014-12-18 00:00:00', '2014-12-08 20:36:19', '(55.9301357, 23.3128603)', NULL),
(27, ' Šiauliai ', 'Kalėdinis koncertas: saksofonistas Sax Gordon su grupe ( JAV ) ', '<div style="text-align: justify;">\n	SAX GORDON - saksofonas, vokalas<br />\n	LUCA GIORDANO - gitara, vokalas<br />\n	WALTER CERASANI - bosinė gitara<br />\n	FABRIZIO GINOBLE - klavišiniai<br />\n	LORENZO POLIANDRI - būgnai<br />\n	<br />\n	Saksofono meistras Sax Gordon&nbsp; – tai vienas įdomiausių ir labiausiai jaudinančių šių dienų atlikėjų. Šis talentingas muzikantas puikiai kaip niekas kitas tęsia amerikietiško ritmenbliuzo, atliekamo saksofonu, tradicijas ir tai daro su beribiu entuziazmu bei drąsa.<br />\n	Turėdamas didžiulį talentą, sukaupęs ilgametę patirtį ir pasižymėdamas neprilygstama energija, Sax Gordon daugybės pasaulio šalių scenose demonstruoja nepakartojamas saksofono partijas, užburdamas tiek klasikiniais, tiek savo kūrybos kūriniais. Artistas naujam gyvenimui prikelia bliuzą, jausmingas balades, soul, svingo muziką ir įpučia gyvybę Amerikos ritmenbliuzo muzikos tradicijoms. Nepaprastas ir rokeriškas Sax Gordon saksofonas dažnai balansuoja ties nuostabaus chaoso riba.<br />\n	Sax Gordon per savo karjerą yra rengęs pasirodymus su tokiomis žvaigždėmis kaip Duke Robillard, Matt „Guitar” Murphy, Jay McShann, Jimmy Witherspoon, „Roomful of Blues“, Junior Watson, John Hammond, Sherman Robertson, Toni Lynn Washington, Solomon Burke ir kitais.<br />\n	Sax Gordon galima išgirsti daugiau nei šimte kompaktinių plokštelių – kartu su klasikinio bliuzo, džiazo ir R&amp;B stiliaus atlikėjais: Kim Wilson, Bryan Lee, Paul Oscher, Jerry Portnoy, Watermelon Slim, Ron Levy, David Maxwell ir daugybe kitų. Sax Gordon gebėjimas „žaisti“ stiliumi, primenančiu didžiuosius R&amp;B saksofono meistrus, suteikė progą užimti solisto vietą muzikos legendų Champion Jack Dupree, Jimmy McGriff, Charles Brown, Pinetop Perkins, Billy Boy Arnold ir Rosco Gordon įrašuose.<br />\n	Sax Gordon išleidęs savo albumus „Have Horn Will Travel“ (1998 m.), „You Knock Me Out” (2000 m.), „Live at the Sax Blast“ (2004 m.) ir „SHOWTIME!“ (2013 m.) ne tik pelnė gausybę apdovanojimų, bet ir įtvirtino stipraus bei puikiai pasaulyje atpažįstamo saksofonisto vardą.<br />\n	Sax Gordon šlovės lentyną puošia ne vienas bliuzo muzikos apdovanojimas: 1998 m. ir 2005 m. muzikantas yra pelnęs „Trophees France Blues“ apdovanojimus, „W. C. Handy Blues Award“ buvo nominuotas 2001 m., 2002 m., 2004 m. ir 2005 m., o „Blues Foundation Blues Award“ atlikėją įvertino 2006 m., 2012 m. ir 2013 m.<br />\n	<br />\n	<strong>Video:</strong><br />\n	<a href="https://www.youtube.com/watch?v=HpThcn9FJl0" target="_blank">https://www.youtube.com/watch?v=HpThcn9FJl0</a><br />\n	<a href="https://www.youtube.com/watch?v=PIVIQKetU3Q" target="_blank">https://www.youtube.com/watch?v=PIVIQKetU3Q</a><br />\n	<br />\n	<strong>Daugiau info: </strong><a href="http://www.gmgyvai.lt ir facebook.com/gmgyvai" target="_blank">www.gmgyvai.lt ir facebook.com/gmgyvai</a><br />\n	<br />\n	<br />\n	<strong>', '2014-12-10 18:00:00', '2014-12-10 00:00:00', '2014-12-08 20:36:25', '(55.9301357, 23.3128603)', NULL),
(28, ' Šiauliai ', 'Coco Chanel project ', '<div style="text-align: justify;">\n	<strong>Coco CHANEL project</strong><br />\n	<br />\n	„Coco CHANEL” – tai teatralizuotas klasikinės – moderniosios muzikos koncertas – performansas, inspiruotas nostalgiškų prisiminimų apie Paryžių ir <strong>Coco Chanel</strong> asmenybę. Šiuo projektu mes atgaiviname XX a. Paryžiaus dvasią: to laikmečio kūrėjus, jų sukurtus šedevrus, autentišką atmosferą ir kitas subtilias šio miesto ypatybes.<br />\n	<br />\n	Šio kūrinio autorė yra <strong>žydų-totorių kilmės kompozitorė Nailia Galiamova, gyvenanti</strong> Lietuvoje, kuri savo kompozicijoje kaip raktą panaudojo <strong>Fr. Poulenc</strong> sentimentaliąją dainą <strong>"Les Chemins de l''amour"</strong>. Kūrinys yra atliekamas prancūzų kalba; tai - siurrealistinis fortepijono pasakojimas apie Coco Chanel bei kvepalus, užkariavusius visą pasaulį!<br />\n	<br />\n	Pagrindinis projekto išskirtinumas – drąsus ir novatoriškas prancūzų kamerinės muzikos interpretavimas, pasitelkiant menų sintezę: mados, šviesos bei kvapų efektus.<br />\n	<br />\n	Pirmą kartą šią premjerą žiūrovai turės galimybę išvysti šių metų gruodžio 13d. – Panevėžyje, gruodžio 18d. – Kaune, gruodžio 20d. -&nbsp; Šiauliuose, gruodžio 22d. – Vilniuje.<br />\n	<br />\n	Kompozitorė <strong>Nailia Galiamova,</strong><br />\n	Aktorius ir režisierius <strong>Gytis Ivanauskas,</strong><br />\n	Kino operatorius <strong>Algimantas Mikutėnas,</strong><br />\n	Kostiumų dizaineriai <strong>Agnė Kuzmickaitė,</strong><br />\n	Sopranas - <strong>Viktorija Miškūnaitė,</strong><br />\n	Fortepijonas - <strong>Eglė Andrejevaitė,</strong><br />\n	Obojus - <strong>Justė Gelgotaitė,</strong><br />\n	Fagotas - <strong>Andrius Puplauskis</strong><br />\n	Šviesų dailininkas – <strong>Arvydas Buinauskas.</strong><br />\n	<br />\n	Renginio video: <a href="http://youtu.be/GzhwbZh3pik" target="_blank">http://youtu.be/GzhwbZh3pik</a><br />\n	<br />\n	&nbsp;</div>\n<strong>', '2014-12-20 18:00:00', '2014-12-20 19:00:00', '2014-12-08 20:36:30', '(55.9301357, 23.3128603)', NULL);
INSERT INTO `events` (`id`, `city`, `name`, `description`, `startDate`, `endDate`, `createdOn`, `map`, `createdBy`) VALUES
(29, ' Vilnius ', 'Vladimir SPIVAKOV ', '<div style="text-align: justify;">\n	<strong>Jubiliejinis Vladimiro Spivakovo ir orkestro „Maskvos virtuozai“ koncertas</strong><br />\n	<br />\n	2015 m. kovo 18 d. “Naujoje Vilniaus koncertų salėje”&nbsp;&nbsp; (Kernavės g. 84, priešais PC „Ozas“) savo jubiliejinį koncertą surengs žymus smuikininikas bei dirigentas Vladimiras Spivakovas ir jo vadovaujamas valstybinis kamerinis orkestras „Maskvos virtuozai”. Šiemet maestro švenčia savo 70-ties metų jubiliejų, o jo orkestras mini 35-erių metų įkūrimo sukaktį.<br />\n	<br />\n	Visame pasaulyje garsus kolektyvas Lietuvos publikai pristatys iškilmingą gala koncertą, kuriame skambės W.A.Mozarto, A.Piazzollos, G.Rossinio, L.Boccherinio, G.Puccinio, L.Delibo ir kitų kompozitorių kūriniai. Kartu su orkestru pasirodys Maskvos Didžiojo teatro solistė A.Jarovaja (sopranas) ir „Naujosios operos“ teatro solistas A.Nekliudovas (tenoras).<br />\n	<br />\n	Gausią klausytojų auditoriją Europoje, JAV ir Azijoje suburiantis kolektyvas jau 35-ąjį sezoną džiugina žiūrovus naujomis programomis, kuriose skamba įvairių žanrų ir epochų klasikinė muzika. Orkestro repertuaras itin platus – nuo J.S.Bacho iki A.Schnittke, o jį atlieka pasaulinio lygio žvaigždės ir tarptautinių konkursų laureatai, kurių kiekvienas – ryški muzikos pasaulio asmenybė.<br />\n	<br />\n	Vieno didžiausių laikraščių Jungtinėse Amerikos valstijose „Los Angeles Times” kritikai šį muzikų kolektyvą vadina šveicarišku laikrodžiu, tikslumo ir elegancijos pavyzdžiu. Prestižinis Europos leidinys „Wiener Zeitung” apžvalginiame straipsnyje pažymi, kad orkestro intonacinis tikslumas, išraiška, aistra bei neįtikėtinai puikūs atlikimo įgūdžiai yra ilgų metų bendro ir atidaus darbo vaisius.<br />\n	<br />\n	Kamerinis orkestras „Maskvos virtuozai” per metus surengia per 100 pasirodymų ir yra koncertavęs kartu su&nbsp; pasaulinio garso žvaigždėmis - Mstislavu Rostropovičiumi, Jevgenijumi Kisinu, Yehundi Menuhinu, Jelena Obrazcova, Jurijumi Bašmetu ir kitais scenos grandais. Orkestro gastrolių geografija taip pat labai plati – kolektyvas jau ne kartą sulaukė audringų ovacijų visose Europos šalyse, JAV, Kanadoje, Meksikoje, Pietų Amerikoje, Turkijoje, Izraelyje, Kinijoje, Korėjoje ir Japonijoje. „Maskvos virtuozai“ pasirodo pačiose geriausiose pasaulio koncertų salėse, tokiose kaip „Concertgebouw“ Amsterdame, „Musikverein“ Vienoje, „Royal Festival Hall“ ir „Albert Hall“ Londone, „Theatre des Champs–Elysees“ Paryžiuje, „Carnegie Hall“ ir „Avery Fisher Hall“ Niujorke, „Suntory Hall“ Tokijuje ir kitose prestižinėse erdvėse.<br />\n	<br />\n	Orkestrą „Maskvos virtuozai“ 1979 m. įkūrė garsus smuikininkas ir dirigentas Vladimiras Spivakovas. Jo batutos mostams paklūsta ne tik šis orkestras, bet ir tokie pripažinti muzikos pasaulyje kolektyvai, kaip Čikagos, Londono, Budapešto, Milano teatro „La Scala" bei kiti garsūs simfoniniai orkestrai. Būtent maestro V.Spivakovo ir jo kruopštaus darbo su kolektyvu dėka šiandien kolektyvas „Maskvos virtuozai“ pelnytai vadinamas vienu geriausių kameriniu orkestru pasaulyje.<br />\n	<br />\n	<strong>Video:</strong><br />\n	<a href="https://www.youtube.com/watch?v=7WlxhBVtGt4" target="_blank">https://www.youtube.com/watch?v=7WlxhBVtGt4</a><br />\n	<a href="https://www.youtube.com/watch?v=mAqSTXgjbA0" target="_blank">https://www.youtube.com/watch?v=mAqSTXgjbA0</a><br />\n	<br />\n	<br />\n	&nbsp;</div>\n<strong>', '2015-03-18 19:00:00', '2015-03-18 21:00:00', '2014-12-08 20:36:36', '(54.711749, 25.276683)', NULL),
(30, ' Utena ', 'Gatvės kultūros festivalis ''''Gyvenimas kitokiu ritmu'''' ', '<strong>Kas yra GKR?</strong><br />\nTai - didžiausias gatvės kultūros renginys šiaurės Lietuvoje, organizuojamas Utenos mieste. Garsiausi Lietuvoje hip hop atlikėjai, grupės, bei šokėjai vienam vakarui suvienija įvairaus amžiaus ir pomėgių žmones, norinčius judėti vienu ritmu.<br />\n<br />\n2004 metais pirmąkart organizuotas koncertas be didesnės reklamos subūrė pačius didžiausius gatvės kultūros gerbėjus, norėjusius išgirsti tokių atlikėjų kaip G&amp;G Sindikatas, Lilas ir Innomine, Garazhe nerūkoma, Mc Messiah kūrinius.<br />\n<br />\n2013 metais vykusiu renginiu susidomėjo daugiau nei 1000 žmonių. Koncerte dalyvavo 15 grupių iš visos Lietuvos. Tiek žiūrovai, tiek atlikėjai koncertą įvertino kaip vieną stipriausių regioninių renginių Lietuvoje.<br />\n<br />\n2014 –aisiais gatvės kultūros festivalis „Gyvenimas kitokiu ritmu“ sugrįžta!<br />\n<br />\n<strong>Kada?</strong><br />\n2014 metų gruodžio 13 dieną<br />\n<br />\n<strong>Kur?</strong><br />\nPop up „GKR spot“, Basanavičiaus g. 59, Utena<br />\n<br />\n<strong>Atlikėjai:</strong><br />\nAshas ir Anika<br />\nDada<br />\nGarazhe Nerūkoma<br />\nSla<br />\nInstinktas<br />\nMc Messiah<br />\nLilas ir Innomine<br />\nMad Money<br />\nba.<br />\nAtlikėjų sąrašas bus pildomas artimiausiu metu.<br />\n<br />\nNaujienos ir informacija: <a href="http://www.facebook.com/gyvenimaskitokiuritmu" target="_blank">www.facebook.com/gyvenimaskitokiuritmu</a><br />\nĮ renginį įleidžiami asmenys sulaukę 16 metų. Jaunesni nei 16 metų asmenys yra įleidžiami tik su pilnamečio asmens palyda, kuris renginio vietoje pasirašo už jo saugumą.<br />\n<br />\n<br />\n<strong>', '2014-12-13 20:00:00', '2014-12-13 00:00:00', '2014-12-08 20:36:41', '(55.4983251, 25.6023114)', NULL),
(31, ' Kaunas ', 'Naujametis Laimos Vaikulės koncertas ', '<div style="text-align: justify;">\n	Gruodžio 30 d. Kauno „Žalgirio” arenoje savo Naujametinį koncertą surengs estrados diva Laima Vaikulė.<br />\n	<br />\n	Populiariosios muzikos stiliaus ikona tituluojama dainininkė kartu su savo muzikantų ir šokėjų grupe Naujųjų metų išvakarėse specialiai Kauno publikai ruošia išskirtinę šventinę programą, kurioje skambės ne tik naujausi, bet ir žinomiausi dainininkės kūriniai, su kuriais užaugo jau ne viena gerbėjų karta.<br />\n	<br />\n	<strong>JI – ypatinga, neprilygstama ir vienintelė. JI – ne tokia kaip visi. JI - LAIMA VAIKULĖ.</strong><br />\n	<br />\n	Šiandien jos vardą žino kiekvienas. Jos dainos verčia džiaugtis ir verkti, stebėtis ir svajoti apie gyvenimą.... Nes jos dainos ir yra GYVENIMAS!<br />\n	Laimos Vaikulės žvaigždė sužibo estrados muzikos padangėje ’80-ųjų viduryje. Netikėtai ir labai ryškiai. Pradedančioji vokalistė stebino absoliučiai viskuo. Ji dainavo ne taip kaip visi, elgėsi scenoje kitaip nei visi. Laima tiesiog kardinaliai išsiskyrė iš visų to meto populiariosios muzikos atlikėjų... Jos net nebuvo su niekuo palyginti!<br />\n	Dainininkės karjera prasidėjo populiariame Jurmalos kabarete „Juras Perle“. Jau tada jausmingas ir gilus Laimos balsas, švelnus latviškas akcentas ir rafinuoto stiliaus pojūtis atverdavo klausytojams dar neregėtus tolius, o subtilūs judesiai ir choreografija tapo tikru kultūriniu šoku to meto publikai. Jos įvaizdis buvo toks pats nuostabus kaip ir muzika, kurią specialiai jai kūrė Raimondas Paulas. Tai būtent ta genialioji muzika, kuriai Laima yra ištikima iki šiol.<br />\n	Po kabareto laikų dainininkė žengė į savo naująją karjeros erą – ji dalyvavo daugybėje muzikos festivalių, tarp kurių „Bratislavos Lyra-87“ (laimėtas Grand Prix), „Metų daina“ Maskvoje, „World Music Award“ Monake ir kituose. Taip pat filmavosi vaidybiniuose ir muzikiniuose filmuose, bendradarbiavo su JAV garso įrašų studija MCA/GRP, kuri išleido sėkmės sulaukusį albumą „Laima Tango“, dalyvavo Naujametiniame „Red-White Show“ Tokijuje ir intensyviai rengė pasaulinius gastrolinius turnė. Laima koncertavo didžiausiose ir prestižinėse koncertų salėse Europoje, JAV, Kanadoje, Izraelyje, tarp kurių - „Carnegie Hall“, „Madison Square Garden“, „Radio City Music Hall“, „Universal Studios“ ir daugelyje kitų.<br />\n	Mokslai Maskvos teatro menų institute (GITIS) suteikė artistei galimybę tapti ne tik savo koncertinių programų autore, bet ir jų režisiere. Ir praėjus daugeliui metų po savo debiuto, Laima prisistatė publikai visiškai naujame amplua – kaip brandi, šiaurietiškai santūri, tačiau beprotiškai seksuali diva. Prie programos pastatymo prisidėjo garsi choreografė Ala Sigalova ir tai buvo neeilinis koncertas – tai buvo tikras ekstravagancijos triumfas. Nuo tada kiekvienas Laimos šou kaskart vis įspūdingesnis, o tobula judesių plastika, profesionalūs šokėjai, elegantiški scenos drabužiai, subtilus rafinuotumas ir aksominis balso tembras priverčia vėl ir vėl žavėtis unikaliu L.Vaikulės talentu.<br />\n	<br />\n	Per savo karjerą Laima įrašė daugiau kaip 10 albumų, kurie buvo parduoti daugiau kaip 20 mln. kopijų tiražu. Dainininkės dainoms buvo sukurta daugybė įspūdingų vaizdo klipų, o jos hitus „Dar ne vakaras“, „Vernisažas“, „Aš išėjau į Piccadilly“, „Acapulco“ ir daugelį kitų mėgsta ir dainuoja milijonai Laimos Vaikulės gerbėjų visose pasaulio šalyse.<br />\n	<br />\n	<strong>Video:</strong><br />\n	<a href="https://www.youtube.com/watch?v=BL-a2PACk5w https://www.youtube.com/watch?v=1w8jAvvDzGA https://www.youtube.com/watch?v=d9TM7YyOSeI https://www.youtube.com/watch?v=tgHk6Uj6DOM" target="_blank">https://www.youtube.com/watch?v=BL-a2PACk5w</a><br />\n	<a href="https://www.youtube.com/watch?v=1w8jAvvDzGA" target="_blank">https://www.youtube.com/watch?v=1w8jAvvDzGA</a><br />\n	<a href="https://www.youtube.com/watch?v=d9TM7YyOSeI" target="_blank">https://www.youtube.com/watch?v=d9TM7YyOSeI</a><br />\n	<a href="https://www.youtube.com/watch?v=tgHk6Uj6DOM" target="_blank">https://www.youtube.com/watch?v=tgHk6Uj6DOM</a><br />\n	<br />\n	<br />\n	<strong>„Žalgirio“ arenos VIP klubo nariams</strong><br />\n	Klubo nariai pirks bilietus už mažiausią neakcijinę kainą nuo 2014 10 16 iki 2014 11 07. Nuo 2014 11 08 neparduoti bilietai patenka į viešą prekybą.<br />\n	<br />\n	&nbsp;</div>\n<strong>', '2014-12-30 19:00:00', '2014-12-30 21:30:00', '2014-12-08 20:36:47', '(54.8985207, 23.9035965)', NULL),
(32, ' Vilnius ', 'Dainuojančios Kalėdos 2014 ', '<div style="text-align: justify;">\n	&bdquo;Dainuojančios Kalėdos&ldquo; &ndash; tai Kalėdinė &scaron;ventė visai &scaron;eimai, kurioje netruks &scaron;ventinės nuotaikos, linksmų dainų ir siurprizų! Pagrindinis &scaron;ventės &bdquo;Dainuojančios Kalėdos&ldquo; akcentas bus popchoro &bdquo;VIESULAS&ldquo; ir studijos &bdquo;TIKS&ldquo; koncertas!<br />\n	Koncerte galėsite i&scaron;girsti daug lietuvi&scaron;kų hitų bei dar niekur neskambėjųsių dainų!<br />\n	Popchoras &bdquo;VIESULAS&ldquo; ir studija &bdquo;TIKS&ldquo; &ndash; jau 13 metų gyvuojantis vaikų ir jaunimo kolektyvas, kuris koncertuoja ne tik Lietuvoje, bet ir Ispanijoje, Latvijoje, Estijoje, Portugalijoje, Lenkijoje, Anglijoje ir Airijoje.<br />\n	Prie&scaron; pat gražiausias metų &scaron;ventes popchoras &bdquo;VIESULAS&ldquo; ir studija &bdquo;TIKS&ldquo; surengs koncertą &bdquo;Didžiausia Kalėdinė &scaron;ventė Airijoje 2014&ldquo;<br />\n	&bdquo;Dainuojančios Kalėdos&ldquo; &ndash; tai pati gražiausia &scaron;ventė ir mažiems, ir dideliems!<br />\n	<br />\n	<br />\n	<strong>', '2014-12-21 19:00:00', '2014-12-21 21:00:00', '2014-12-08 20:36:52', '(54.686206, 25.2751129)', NULL),
(33, ' Kaunas ', 'Naujųjų Metų sutikimo šventė ', '<div style="text-align: justify;">\n	<strong>Sutikime 2015- uosius legendinėje Kauno halėje!</strong><br />\n	<br />\n	Naujųjų Metų vakarą mūsų bendrapiliečių visuomet laukia gausus pasirinkimas koncertų, spektaklių, ar kitokių renginių.<br />\n	<br />\n	Mūsų &scaron;ventinis renginys žmonėms patinka tuo, jog jame galima susitikti su mylimais atlikėjais dar kartą paskutinį metų vakarą; pabūti bendraamžių ir bendraminčių būryje: o svarbiausia &ndash; po koncerto visiems kartu, aidint &ndash; fejerverkams sutikti NAUJUOSIUS METUS!<br />\n	<br />\n	Būsime atviri &ndash; tai renginys brandesniam žiūrovui.<br />\n	<br />\n	Originaliausia yra tai, jog, tikriausiai vienintelę unikalią galimybę Lietuvoje tokiai &scaron;ventei turi Kauno Dariaus ir Girėno sporto kompleksas, kur patalpa koncertui &ndash; halė ir galimybė stebėti fejerverką nuo stadiono tribūnų yra vienoje vietoje.<br />\n	<br />\n	&nbsp;&nbsp;&nbsp; Tad maloniai kviečiame visus, kurie pas mus sutinka Naujuosius metus jau nebe pirmą kartą, o taip pat ir tuos, kurie pas mus dar nesisvečiavo. Pasvarstykite, pasitarkite, tik &ndash; nuo&scaron;irdžiai patarsime &ndash; nesnauskite. Halė nors ir legendinė, bet nedidukė. Jau lapkričio mėnesį pradedame jausti vietų deficitą.<br />\n	<br />\n	<strong>RPOGRAMA:</strong><br />\n	<br />\n	<u>I DALIS 21:00 val.</u><br />\n	<strong>KAUNO MIESTO SIMFONINIS ORKESTRAS</strong><br />\n	Vadovas A.Treikauskas<br />\n	<strong>Operos solistai:</strong><br />\n	VLADIMIRAS PRUDNIKOVAS<br />\n	JUDITA LEITAITĖ<br />\n	<strong>Baleto primarijus</strong><br />\n	NERIJUS JU&Scaron;KA IR PARTNERIAI<br />\n	<br />\n	<u>II DALIS 22:30 val.</u><br />\n	<strong>Įžymiausias Lietuvos tenoras</strong><br />\n	MERŪNAS<br />\n	<strong>Chorų karų laureatas</strong><br />\n	RAIGARDO TAUTKAUS &Scaron;AMPANINIS KAUNO CHORAS<br />\n	<br />\n	<u>III DALIS 00:00 val.</u><br />\n	<strong>VIDURNAKČIO FEJERVERKŲ IR MUZIKOS &Scaron;OU!</strong><br />\n	<strong>Renginio vedėjai:</strong><br />\n	Aktoriai: VIRGINIJA KOCHANSKYTĖ, VILIUS KAMINSKAS<br />\n	<br />\n	&nbsp;</div>\n<strong>', '2014-12-31 00:00:00', '2015-01-01 00:00:00', '2014-12-08 20:37:02', '(54.8961464, 23.9350053)', NULL),
(34, ' Šiauliai ', 'Džentelmenai- nauja programa ''''Deganti aistra'''' ', '<div style="text-align: justify;">\n	<strong>Grupė &bdquo;Džentelmenai&ldquo; pristato naują aistra ir kar&scaron;čiu pulsuojančią programą &bdquo;Deganti aistra&ldquo;</strong><br />\n	<br />\n	Ar teko kada regėti vienoje vietoje meilę, aistrą, &scaron;okį ir užvedančius muzikos ritmus? Keturi scenos Džentelmenai: Andrius Butkus, Dainius Dim&scaron;a, Vytautas Mackonis ir Tadas Rimgaila pristato naują kraują kaitinančią programą &bdquo;Deganti aistra&ldquo;, kuri nune&scaron; Jus į kitą erdvę...<br />\n	Gundantys kūnai, užvedančios dainos ir tobula choreografija &ndash; visa tai Jums pažada dainuojančių &scaron;okėjų kompanija.<br />\n	<br />\n	Kviečiame niūrius rudens vakarus praleisti &scaron;ių temperamentingų vyrukų kompanijoje ir paskęsti aistros sūkuryje...<br />\n	Koncerte Jūsų laukia staigmenos ir siurprizai!<br />\n	<br />\n	&nbsp;</div>\n<strong>', '2014-12-13 17:00:00', '2014-12-13 18:30:00', '2014-12-08 20:37:08', '(55.9301357, 23.3128603)', NULL),
(35, ' Latvija ', 'SEKS, BRAK I RAZVOD PO-AMERIKANSKI ', '<p>\n	<font face="Verdana" style="font-size: 8pt"><b>Amžiaus cenzas: </b>N16<br />\n	<b>Renginio kalba: </b>rusų<br />\n	<b>Renginio trukmė: </b>~1h40min</font><br />\n	<br />\n	</p>\n', '2014-12-18 19:00:00', '2014-12-18 00:00:00', '2014-12-08 20:37:23', '(56.9489246, 24.1210986)', NULL),
(36, ' Vilnius ', 'Paroda ''''Mūsų vestuvės'''' ', '<div style="text-align: justify;">\n	Vestuvinių paslaugų paroda- &scaron;ventė &quot;Mūsų Vestuvės&quot;<br />\n	<br />\n	Parodų organizatorius UAB &bdquo;Boules D&lsquo;or&ldquo; pristato jau septintą kartą Lietuvoje vykstančią vestuvinių paslaugų parodą &ndash; &scaron;ventę &quot;Mūsų vestuvės&quot;.<br />\n	Laikas: 2015 m. vasario 7 - 8 d. Tikros, nesuvaidintos emocijos, konkursai - viskas Jums!<br />\n	Vieta: vie&scaron;butis &bdquo;Radisson Blu Hotel Lietuva&rdquo;, Konstitucijos pr. 20, LT-09308 Vilnius. Dėl papildomos informacijos ir dalyvavimo kreiptis:<br />\n	Tel.: +370 5 205 46 11<br />\n	Mob.: +370 630 84 949<br />\n	<a href="mailto:info@musuvestuves.lt">info@musuvestuves.lt</a><br />\n	<a href="http://www.musuvestuves.lt" target="_blank">www.musuvestuves.lt</a><br />\n	<br />\n	<br />\n	<strong>', '2015-02-07 00:00:00', '2015-02-08 00:00:00', '2014-12-08 20:37:29', '(54.6952289, 25.274629)', NULL),
(37, 'Kaunas', 'est', 'estasada fsdf sd fsd gsdfg df gd fg', '2015-01-01 00:00:00', '2018-01-01 00:00:00', '2014-12-08 21:12:41', '(54.8985207, 23.90359650000005)', 30),
(38, 'Kaunas', 'pavadinimas', 'tekstas afdndjf dsf iusdbf iusdbfu sbiudf', '2015-01-01 00:00:00', '2019-01-01 00:00:00', '2014-12-08 21:19:09', '(54.8985207, 23.90359650000005)', 30),
(39, 'Kaunas', 'nauajs', 'naujas adf fg dg dfg dg d', '2015-01-01 00:00:00', '2019-01-01 00:00:00', '2014-12-08 21:30:40', '(54.8985207, 23.90359650000005)', 30),
(40, 'Kaunas', 'testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas', 'testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas  testas testas testastestas testas testas testastestas', '2015-01-01 00:00:00', '2018-01-01 00:00:00', '2014-12-09 02:32:35', '(54.8985207, 23.90359650000005)', 41);

-- --------------------------------------------------------

--
-- Table structure for table `event_comments`
--

CREATE TABLE IF NOT EXISTS `event_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL,
  `eventId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_19727FFA2B2EBB6C` (`eventId`),
  KEY `IDX_19727FFA64B64DCC` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_keywords`
--

CREATE TABLE IF NOT EXISTS `event_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ECB35C8E2B2EBB6C` (`eventId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=172 ;

--
-- Dumping data for table `event_keywords`
--

INSERT INTO `event_keywords` (`id`, `keyword`, `eventId`) VALUES
(10, 'festivalis', 12),
(11, 'kilkim', 12),
(12, 'žaibu', 12),
(13, '2015', 12),
(14, 'šventinis', 13),
(15, 'koncertas', 13),
(16, 'mantra', 13),
(17, 'improvizacijos', 13),
(18, 'emir', 14),
(19, 'kusturica', 14),
(20, 'no', 14),
(21, 'smoking', 14),
(22, 'orchestra', 14),
(23, 'yann', 15),
(24, 'tiersen', 15),
(25, 'omnis', 16),
(26, 'una', 16),
(27, 'gaudeamus', 16),
(28, 'berniukų', 16),
(29, 'ir', 16),
(30, 'jaunuolių', 16),
(31, 'choro', 16),
(32, 'dagilėlis', 16),
(33, 'koncertas', 16),
(34, 'saulės', 17),
(35, 'šerytės', 17),
(36, 'ir', 17),
(37, 'donaldo', 17),
(38, 'račio', 17),
(39, 'koncertas', 17),
(40, 'rebelheart', 18),
(41, 'albumo', 18),
(42, 'mysteria', 18),
(43, 'pristatymas', 18),
(44, 'koncerto', 18),
(45, 'svečias', 18),
(46, 'arina', 18),
(47, 'naujametis', 19),
(48, 'koncertas', 19),
(49, 'lito', 19),
(50, 'palydos', 19),
(51, 'su', 19),
(52, 'ansambliu', 19),
(53, 'lietuva', 19),
(54, 'ir', 19),
(55, 'humoriste', 19),
(56, 'violeta', 19),
(57, 'mičiuliene', 19),
(58, 'vilnius', 20),
(59, 'jazz', 20),
(60, '2015', 20),
(61, 'kalėdinė', 21),
(62, 'muzikinė', 21),
(63, 'pasaka', 21),
(64, 'vaikams', 21),
(65, 'mauliukas', 21),
(66, 'vitalijos', 22),
(67, 'katunskytės', 22),
(68, 'ir', 22),
(69, 'draugų', 22),
(70, 'kalėdinis', 22),
(71, 'koncertas', 22),
(72, 'vaidas', 23),
(73, 'baumila', 23),
(74, 'albumo', 23),
(75, 'iš', 23),
(76, 'naujo', 23),
(77, 'pristatymo', 23),
(78, 'koncertas', 23),
(79, 'šeimadienis', 24),
(80, 'šeimos', 24),
(81, 'festivalis', 24),
(82, 'līvu', 25),
(83, 'vandens', 25),
(84, 'parkas', 25),
(85, 'kalėdų', 25),
(86, 'dovanų', 25),
(87, 'kortelė', 25),
(88, 'didysis', 26),
(89, 'kalėdinis', 26),
(90, 'koncertas', 26),
(91, '2014', 26),
(92, 'kalėdinis', 27),
(93, 'koncertas', 27),
(94, 'saksofonistas', 27),
(95, 'sax', 27),
(96, 'gordon', 27),
(97, 'su', 27),
(98, 'grupe', 27),
(99, 'jav', 27),
(100, 'coco', 28),
(101, 'chanel', 28),
(102, 'project', 28),
(103, 'vladimir', 29),
(104, 'spivakov', 29),
(105, 'gatvės', 30),
(106, 'kultūros', 30),
(107, 'festivalis', 30),
(108, 'gyvenimas', 30),
(109, 'kitokiu', 30),
(110, 'ritmu', 30),
(111, 'naujametis', 31),
(112, 'laimos', 31),
(113, 'vaikulės', 31),
(114, 'koncertas', 31),
(115, 'dainuojančios', 32),
(116, 'kalėdos', 32),
(117, '2014', 32),
(118, 'naujųjų', 33),
(119, 'metų', 33),
(120, 'sutikimo', 33),
(121, 'šventė', 33),
(122, 'džentelmenai', 34),
(123, 'nauja', 34),
(124, 'programa', 34),
(125, 'deganti', 34),
(126, 'aistra', 34),
(127, 'seks', 35),
(128, 'brak', 35),
(129, 'i', 35),
(130, 'razvod', 35),
(131, 'po-amerikanski', 35),
(132, 'paroda', 36),
(133, 'mūsų', 36),
(134, 'vestuvės', 36),
(135, 'kobe', 37),
(136, 'lebron', 37),
(137, 'lol', 37),
(138, 'est', 37),
(139, 'a', 38),
(140, 'b', 38),
(141, 'c', 38),
(142, 'd', 38),
(143, 'pavadinimas', 38),
(144, 'a', 39),
(145, 'b', 39),
(146, 'c', 39),
(147, 'd', 39),
(148, 'nauajs', 39),
(149, 'kaunas', 40),
(150, 'test', 40),
(151, 'lebron', 40),
(152, 'kobe', 40),
(153, 'kobe', 40),
(154, 'testas', 40),
(155, 'testas', 40),
(156, 'testastestas', 40),
(157, 'testas', 40),
(158, 'testas', 40),
(159, 'testastestas', 40),
(160, 'testas', 40),
(161, 'testas', 40),
(162, 'testastestas', 40),
(163, 'testas', 40),
(164, 'testas', 40),
(165, 'testastestas', 40),
(166, 'testas', 40),
(167, 'testas', 40),
(168, 'testastestas', 40),
(169, 'testas', 40),
(170, 'testas', 40),
(171, 'testastestas', 40);

-- --------------------------------------------------------

--
-- Table structure for table `event_photos`
--

CREATE TABLE IF NOT EXISTS `event_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3AEF978B2B2EBB6C` (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `name`, `facebook_id`, `facebook_access_token`, `city`) VALUES
(1, 'a@a.lt', 'a@a.lt', 'a@a.lt', 'a@a.lt', 1, 'oplyinm4pw08ocososkgk0cgc00og0s', 'Bq1sPJ0n9mAGxtJGSoJTh8p+qgzm/EpqVdNf884x12y7NVynElypiWzeEFY2nPOf2yt1XqVpBNmimMpi7F1Ang==', '2014-11-04 18:38:55', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'asas', NULL, NULL, ''),
(2, 'b@b.lt', 'b@b.lt', 'b@b.lt', 'b@b.lt', 1, '73qgjharm38ckcg8scgo08os8k884ck', 'wbJstEParAQqNoVGLyyaeqCjb4iCSWkTwn1eqLTIY6AbFuDeeh6HkaN7G6vvh2qI5yDf2wlV5uksWZdMxnmg2g==', '2014-11-11 21:59:06', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'baba', NULL, NULL, ''),
(3, 'zarokas@gmail.com', 'zarokas@gmail.com', 'zarokas@gmail.com', 'zarokas@gmail.com', 1, '5524udlxjp8g8sgocgg8kwcckk4wgk0', 'To/9KaFkwgqNxJDnJYZhn1XEFoUtj3aJGBBcQxxAXZ6C0U1cLRtrU7GoiexDcvzpHZXrs90S/+wS1Hi0V9BC9g==', '2014-12-10 11:39:54', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Ged Kat', '4841981704301', 'CAAHey8iIeAoBAJ1u9iHjVNfG9YZCg5XUVCnWcM6BNu9slipZBdUQxpS7FCFomXVhowSpXcPNZC5ZAwCVLnfq2WBADqyyZBHYDgZCZC0wZBZBYHyo3prREORJczT4tsY0xu4Vv9zXw8vf4gebakxW1n9EPxn1ZABgV3e2XOABREktW8jBORVFjlZCqrecgcJZAcx28gUB37V2BqlD2sFU5vDEZCjIr', 'Kaunas'),
(30, 'zarokass@gmail.com', 'zarokass@gmail.com', 'zarokass@gmail.com', 'zarokass@gmail.com', 1, 'p4dbrxm1pn48o4w84ko88s4css4gss8', 'sLc9aherX/naTayANvI/nY1eG8PGurusS0e9bd2c91RVVtRX7bPkBX2DNaUb13/MT8DtwSVOTwiwz4ORVfnLzQ==', '2014-12-08 20:33:53', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'Gediminas', NULL, NULL, NULL),
(32, 'ges@gmail.com', 'ges@gmail.com', 'ges@gmail.com', 'ges@gmail.com', 1, 'kq7to3fatlcckgw004k0g84ss4ksggs', 'Rrf7T0pK2DY4ENdDX1gHOiAFyvlIwc1pbysCMRyqNKdB1pKaCScQlF6Ki61203R04C6Jv0QAi2COINUVdHtlOw==', '2014-12-08 22:00:25', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'ged', NULL, NULL, NULL),
(33, 'alfamegaxq@ktu.lt', 'alfamegaxq@ktu.lt', 'alfamegaxq@ktu.lt', 'alfamegaxq@ktu.lt', 1, 'c0pjnyjjl3k88wwgksk0848c008kks0', 'DtW3E8rDcjV5+vNDG7OhYpO1xVXVtlsq/H0zDVuxmBLFAfcPyNf3OuQvkmNG2u1oRlvyRvnf7a6a36sCSOMmBg==', '2014-12-08 22:21:04', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'alfamegaxq', NULL, NULL, NULL),
(34, 'zar@zas.lr', 'zar@zas.lr', 'zar@zas.lr', 'zar@zas.lr', 1, 'fydbk6o6ofwcg4kgo4k4w44gkosko8s', 'UGPmHEPe1Ky36dqrWWEp1905w6+vR6vqzLPav2QmUhFzvfo6GH3iYk8fCVyC2ICb/OMAQpC6EqexeT7i8vN2Gg==', '2014-12-08 22:36:01', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'zaroks', NULL, NULL, NULL),
(35, 'test@test.lt', 'test@test.lt', 'test@test.lt', 'test@test.lt', 1, '6vvfbzj4ickk0g4okckogc0woggogww', 'E8pPNM+X3sYaMjJ3lfBpIFvz2UO8d+3GlkIKKD/XAvf/8U+zK1wp7o6d1PHUbufhWO2Nxz8Er3RAl00Z4DUcVA==', '2014-12-08 23:07:55', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'test', NULL, NULL, NULL),
(36, 'yogs@yogscast.com', 'yogs@yogscast.com', 'yogs@yogscast.com', 'yogs@yogscast.com', 1, 'n0g9dq0i7m88wk4ogskgs4s08k8g44s', '5TZ2wms8W4R9mFmvp9Lp9RQnG8OqPO+JbVjmFBJbaChzCUlDqOfopYApT8gOr8GqmhwEp4+6bT7lFWEMsC7g6g==', '2014-12-08 23:16:06', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'yogs', NULL, NULL, NULL),
(37, 'ramin@tm.lt', 'ramin@tm.lt', 'ramin@tm.lt', 'ramin@tm.lt', 1, 'fvy6ifpqxbksg8o4ow0co4o8sg8w00o', 'inTcyZYXw951shCqYZaQMtK49/5gd9Dka2kCrPGe7LBUg4kobt/7yjpUPO9GOkz6+W6wUbe6oMulAY0a8WeDuw==', '2014-12-08 23:18:19', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'ramin', NULL, NULL, NULL),
(38, '2fdf2bhidjfsf@fdsfsd.lt', '2fdf2bhidjfsf@fdsfsd.lt', '2fdf2bhidjfsf@fdsfsd.lt', '2fdf2bhidjfsf@fdsfsd.lt', 1, '83zhmqqq2sso04k0w4ggck8wwcgc4wk', 'QPMgWx0w3xYa7x9s0clBurFvTFjwkOZ8+NJiSvQcWYj5ffr5eYR0Wxy6pTu6SrfWU6MCGr5aIqegnQ4SaC4M6g==', '2014-12-08 23:37:19', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'tustas', NULL, NULL, 'Kaunas'),
(41, 'zarokas@gmail.comfdsfs', 'zarokas@gmail.comfdsfs', 'zarokas@gmail.comfdsfs', 'zarokas@gmail.comfdsfs', 1, 'gr5kzsx8z34kgwwo8wokkkgw004ooos', '2m7itdco2elD6F1EG98AsP2mmMSpDo6sKCscp2kmWbaNSU4WOI2ZHjhVgLzwWMXNNuOIw/rs43LAXMg5e/xGsg==', '2014-12-10 11:38:34', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Ged Kat', '', '', 'Kaunas'),
(42, 'tesg@tes.tes', 'tesg@tes.tes', 'tesg@tes.tes', 'tesg@tes.tes', 1, '8h04f4rg25c0800s4s4cwosk40og8so', 'b3ztzSuDT/4Wj7pi53oZ5ooGEI8SHpd+rY/Iirx1YrKKuLKv8iTBR17wx50WK8tO+RumMCkt6Pwjmgi75VoQ3g==', '2014-12-09 08:27:56', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'tesg', NULL, NULL, 'Kaunas');

-- --------------------------------------------------------

--
-- Table structure for table `users_attending`
--

CREATE TABLE IF NOT EXISTS `users_attending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `eventId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E80E51664B64DCC` (`userId`),
  KEY `IDX_5E80E5162B2EBB6C` (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

CREATE TABLE IF NOT EXISTS `user_interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `updatedDate` datetime NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_C854880E64B64DCC` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=239 ;

--
-- Dumping data for table `user_interests`
--

INSERT INTO `user_interests` (`id`, `keyword`, `userId`, `updatedDate`, `value`) VALUES
(212, 'testas3', 3, '2014-12-10 14:32:29', 1),
(213, '1822115397', 3, '2014-12-10 14:33:15', 1),
(214, '492488116', 3, '2014-12-10 14:38:42', 1),
(215, '1266014724', 3, '2014-12-10 14:39:30', 1),
(216, '349188909', 3, '2014-12-10 14:40:11', 1),
(217, '765274394', 3, '2014-12-10 14:40:30', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_5387574AD3564642` FOREIGN KEY (`createdBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `event_comments`
--
ALTER TABLE `event_comments`
  ADD CONSTRAINT `FK_19727FFA2B2EBB6C` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `FK_19727FFA64B64DCC` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `event_keywords`
--
ALTER TABLE `event_keywords`
  ADD CONSTRAINT `FK_ECB35C8E2B2EBB6C` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`);

--
-- Constraints for table `event_photos`
--
ALTER TABLE `event_photos`
  ADD CONSTRAINT `FK_3AEF978B2B2EBB6C` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`);

--
-- Constraints for table `users_attending`
--
ALTER TABLE `users_attending`
  ADD CONSTRAINT `FK_5E80E5162B2EBB6C` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `FK_5E80E51664B64DCC` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_interests`
--
ALTER TABLE `user_interests`
  ADD CONSTRAINT `FK_C854880E64B64DCC` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
