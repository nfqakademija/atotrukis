<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /**
     * shows all events
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $events = $this->get('homePageService')->getEvents();

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
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.context')->getToken()->getUser()->getId();
            $amIAttending = $this->get('eventService')->isUserAttendingEvent($eventId, $user);
        } else {
            $amIAttending = null;
        }
        return $this->render('AtotrukisMainBundle:Default:showEvent.html.twig', array(
            'event' => $event, 'attending'=> $attending, 'userRegistered' => $amIAttending,
        ));
    }


}
