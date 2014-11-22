<?php

namespace Atotrukis\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Atotrukis\MainBundle\Entity\Event;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $entiTyManager)
    {
        for ($i = 0; $i < 300; $i++) {
            $names = array("Koncertas", "Miesto šventė", "Parduotuvės atidarymas",
                "Futbolo varžybos", "Krepšinio varžybos",
                "Šokiai", "Paroda", "Karaoke", "Protmūšis", "Spektaklis", "Paskaita", "Festivalis", "Muzikos vakaras");
            $descriptions = array("Labai įdomus renginys", "Linksmas laiko praleidimas", "Įdomu", "Smagu",
                "Čia toks labai įdomus renginys, kuriame pamatysite visokių įdomių dalykų, kurie bus labai linksmi.");
            $cities = $entiTyManager->getRepository('AtotrukisMainBundle:City')->findAll();
            $dates = array("2014-11-30 23:00", "2014-12-18 18:00", "2014-12-04 22:00", "2015-01-01 15:00",
                "2014-12-07 18:00", "2014-12-09 19:00", "2014-12-11 16:00", "2014-12-13 19:00", "2014-12-20 14:00");
            $event = new Event();
            $event->setName($names[array_rand($names, 1)]);
            $event->setDescription($descriptions[array_rand($descriptions, 1)]);
            $event->setStartDate(new \DateTime($dates[array_rand($dates, 1)]));
            $event->setEndDate(new \DateTime("2016-10-10"));
            $event->setCity($cities[array_rand($cities, 1)]);
            $event->setMap("(54.8985207, 23.90359650000005)");
            $entiTyManager->persist($event);
            $entiTyManager->flush();
        }

    }

    public function getOrder()
    {
        return 2;
    }
}