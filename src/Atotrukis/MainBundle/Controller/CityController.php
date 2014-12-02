<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends Controller
{

    // TODO: use this function to get ip address when deployed to server
    // TODO: send to service
    // when in server runs in virtual box this function wont get correct ip
    private function getUserIP()
    {
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

    //TODO: throw code to service
    public function setCityAction()
    {
        $geoip = $this->get('maxmind.geoip')->lookup('87.247.118.209');
        $currCity = $geoip->getCity();

        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $userCity = $this->get('security.context')->getToken()->getUser()->getCity();
            if ($userCity == null) {
                //set database user city
                $userId = $this->get('security.context')->getToken()->getUser()->getId();
                $this->get('cityService')->setCity($currCity, $userId);
            }
        } else {
           //check cookie
            if (!isset($_COOKIE['userCity'])) {
                return new JsonResponse(array('data' => 'not set'));
                $cookie_name = "userCity";
                $cookie_value = $currCity;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            }
        }
    }
}
