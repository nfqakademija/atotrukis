<?php

namespace Atotrukis\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Atotrukis\MainBundle\Entity\City;

class LoadCityData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $em)
    {
        $city = new City(); $city->setName("Kaunas"); $city->setPriority(1);  $em->persist($city); $em->flush();
        $city = new City(); $city->setName("Vilnius"); $city->setPriority(1);  $em->persist($city); $em->flush();
        $city = new City(); $city->setName("Klaipėda"); $city->setPriority(1); $em->persist($city); $em->flush();
        $city = new City(); $city->setName("Alytus"); $city->setPriority(1); $em->persist($city); $em->flush();
        $city = new City(); $city->setName("Šiauliai"); $city->setPriority(1); $em->persist($city); $em->flush();
        $city = new City(); $city->setName("Panevėžys"); $city->setPriority(1); $em->persist($city); $em->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}