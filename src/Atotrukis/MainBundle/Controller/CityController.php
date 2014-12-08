<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends Controller
{

    public function setCityAction()
    {
        $cityService = $this->get('cityService');
        $currCity = $cityService->getCity();

        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $userCity = $this->get('security.context')->getToken()->getUser()->getCity();
            if ($userCity == null) {
                //set database user city
                $userId = $this->get('security.context')->getToken()->getUser()->getId();
                $cityService->setCity($currCity, $userId);
            }
        } else {
            $cityService->setCityCookie($currCity);
        }
    }
}
