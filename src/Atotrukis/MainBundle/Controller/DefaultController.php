<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($max = 10)
    {
        $events = $this->get('homePageService')->getEvents();

        if (!$events) {
            //TODO not a solution
           // throw $this->createNotFoundException('Nėra nei vieno renginio')
        }

        $startDate = $this->get('dateFormatService')->startDate($events);
        $endDate = $this->get('dateFormatService')->endDate($events);

        $paginator  = $this->get('knp_paginator');
        $pagination = $this->get('homePageService')->
            paginate($paginator, $this->get('request')->query->get('puslapis', 1), $max);
        if ($pagination->getPaginationData()['current'] > 1) {
            $pagination = $this->get('homePageService')->
                paginate($paginator, $this->get('request')->query->get('puslapis', 1), 12);
        }

        $attending = [];
        foreach ($events as $event) {
            $eventId = $event->getId();
            $attending[$eventId] = $this->get('eventService')->getAttending($eventId);
        }

        return $this->render('AtotrukisMainBundle:Default:index.html.twig', array(
            'pagination' => $pagination,
            'startDate' => $startDate, 'endDate' => $endDate,
            'attending' => $attending,
        ));

    }


    public function showEventAction($eventId)
    {
        $attending = $this->get('eventService')->getAttending($eventId);

        // Getting event data from id
        $event = $this->get('doctrine')->getManager()->getRepository('AtotrukisMainBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        return $this->render('AtotrukisMainBundle:Default:showEvent.html.twig', array(
            'event' => $event, 'attending'=> $attending
        ));
    }


}
