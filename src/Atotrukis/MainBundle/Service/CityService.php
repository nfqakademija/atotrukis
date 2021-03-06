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
        if ($user->getCity() != "NULL") {
            $user->setCity($city);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }

    // when in server runs in virtual box this function wont get correct ip
    //set $testServer to false to get visitor ip
    public function getUserIP($testServer = true)
    {
        if (!$testServer) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return '87.247.118.209';
        }
    }



    public function setCityCookie( $city)
    {
        if (!isset($_COOKIE['userCity'])) {
            $cookie_name = "userCity";
            $cookie_value = $city;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        }
    }
}
