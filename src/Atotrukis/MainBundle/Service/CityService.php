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

    // when in server runs in virtual box this function wont get correct ip
    private function getUserIP(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public function getCity()
    {
        $geoip = $this->get('maxmind.geoip')->lookup('87.247.118.209');
        $currCity = $geoip->getCity();
        return $currCity;
    }

    public function setCityCookie( $city){
        if (!isset($_COOKIE['userCity'])) {
            $cookie_name = "userCity";
            $cookie_value = $city;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        }
    }
}
