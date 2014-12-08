<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function locateCityAction()
    {
        $city = $this->get('maxmind.geoip')->lookup('87.247.118.209')->getCity();
        $user = $this->get('security.context')->getToken()->getUser()->getId();
        $this->get('cityService')->setCity($city, $user);
        return $this->redirect($this->generateUrl('atotrukis_hello_world'));
    }

    /**
     * shows all events
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $geoip = $this->get('maxmind.geoip')->lookup('87.247.118.209');
        $this->get('homePageService')->setGeoIp($geoip);
        $events = $this->get('homePageService')->getEvents($geoip);

        $startDate = $this->get('dateFormatService')->startDate($events);
        $endDate = $this->get('dateFormatService')->endDate($events);

        list($amIAttending, $attending) = $this->get('homePageService')->getAttending();
        return $this->render('AtotrukisMainBundle:Default:index.html.twig', array(
            'events' => $events,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'attending' => $attending,
            'userRegistered' => $amIAttending,
        ));
    }


    /**
     * shows details of event
     *
     * @param $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEventAction($eventId)
    {
        $attending = $this->get('eventService')->getAttending($eventId);
        
        $event = $this->get('doctrine')->getManager()->getRepository('AtotrukisMainBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        $startDate = $this->get('dateFormatService')->changeDate($event->getStartDate());
        $endDate = $this->get('dateFormatService')->changeDate($event->getEndDate());

        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.context')->getToken()->getUser()->getId();
            $amIAttending = $this->get('eventService')->isUserAttendingEvent($eventId, $user);
        } else {
            $amIAttending = null;
        }
        return $this->render('AtotrukisMainBundle:Default:showEvent.html.twig', array(
            'event' => $event,
            'attending'=> $attending, 'userRegistered' => $amIAttending,
            'startDate' => $startDate, 'endDate' => $endDate
        ));
    }


}
