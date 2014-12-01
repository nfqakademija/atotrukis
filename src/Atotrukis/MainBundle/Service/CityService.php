<?php
namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Class CityService
 * @package Atotrukis\MainBundle\Service
 */
class CityService
{
    protected $entityManager;


    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $city
     * @param $userId
     */
    public function setCity($city, $userId)
    {
        $user = $this->entityManager->getRepository("AtotrukisMainBundle:User")->
            findOneBy(array('id' => $userId));
        $user->setCity($city);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

}
