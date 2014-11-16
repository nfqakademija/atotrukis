<?php

namespace Atotrukis\MainBundle\Service;

class GettingCityService
{
    public function getCity() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $json = file_get_contents("http://ipinfo.io/");
        $details = json_decode($json);
        if (!$details->city) {
            $json = file_get_contents("http://ipinfo.io/$ip");
            $details = json_decode($json);
        }
        return $details->city;
    }
}