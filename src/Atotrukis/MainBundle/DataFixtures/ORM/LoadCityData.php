<?php

namespace Atotrukis\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Atotrukis\MainBundle\Entity\City;

class LoadCityData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $entityManager)
    {
        $this->setValues("Kaunas", $entityManager);
        $this->setValues("Vilnius", $entityManager);
        $this->setValues("Klaipėda", $entityManager);
        $this->setValues("Alytus", $entityManager);
        $this->setValues("Šiauliai", $entityManager);
        $this->setValues("Panevėžys", $entityManager);
    }

    private function setValues($name, $entityManager)
    {
        $city = new City();
        $city->setName($name);
        $city->setPriority(1);
        $entityManager->persist($city);
        $entityManager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}