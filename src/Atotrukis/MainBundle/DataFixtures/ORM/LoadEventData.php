<?php

namespace Atotrukis\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Atotrukis\MainBundle\Entity\Event;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $em)
    {
        for ($i = 0; $i < 300; $i++) {
            $names = array("Koncertas", "Miesto šventė", "Parduotuvės atidarymas", "Futbolo varžybos", "Krepšinio varžybos",
                "Šokiai", "Paroda", "Karaoke", "Protmūšis", "Spektaklis", "Paskaita", "Festivalis", "Muzikos vakaras");
            $descriptions = array("Labai įdomus renginys", "Linksmas laiko praleidimas", "Įdomu", "Smagu", "Čia toks labai įdomus renginys, kuriame pamatysite visokių įdomių dalykų, kurie bus labai smagūs ir linksmi.");
            $cities = $em->getRepository('AtotrukisMainBundle:City')->findAll();
            $dates = array("2014-11-05 23:00", "2014-12-04 18:00", "2014-11-04 22:00", "2015-01-01 15:00", "2014-11-07 18:00", "2014-11-09 19:00", "2014-11-11 16:00", "2014-11-13 19:00", "2014-11-20 14:00");
            $event = new Event();
            $event->setName($names[array_rand($names, 1)]);
            $event->setDescription($descriptions[array_rand($descriptions, 1)]);
            $event->setStartDate(new \DateTime($dates[array_rand($dates, 1)]));
            $event->setEndDate(new \DateTime("2016-10-10"));
            $event->setCity($cities[array_rand($cities, 1)]);
            $event->setMap("https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2293.942924457549!2d23.957789!3d54.90392399999999!3m2!1i1024!2i768!4f13.1!5e0!3m2!1slt!2slt!4v1414796027316");
            $em->persist($event);
            $em->flush();
        }

    }

    public function getOrder()
    {
        return 2;
    }
}