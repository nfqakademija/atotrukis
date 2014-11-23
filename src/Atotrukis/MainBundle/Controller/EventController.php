<?php

namespace Atotrukis\MainBundle\Controller;

use Atotrukis\MainBundle\Form\Type\CreateEventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Atotrukis\MainBundle\Entity\Event;
use Atotrukis\MainBundle\Form\Type\CreateEventFormType;
use Symfony\Component\HttpFoundation\JsonResponse;

class EventController extends Controller
{

    public function createEventAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm(new CreateEventFormType(), $event);

        $this->get('eventService')->createEvent($event, $form, $request, $this->getUser());
        return $this->render('AtotrukisMainBundle:Event:addEvent.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function readUserEventsAction(Request $request)
    {

        $userEvents = $this->get('eventService')->readUserEvents($this->getUser(), $request);

        return $this->render('AtotrukisMainBundle:Event:myEvents.html.twig', array('events' => $userEvents));

    }

    public function deleteMyEventAction($eventId, Request $request)
    {
        $this->get('eventService')->deleteUserEvent($eventId, $this->getUser(), $request);
        return $this->redirect($this->generateUrl('my_events'));
    }

    public function editMyEventAction(Request $request, $eventId)
    {

        $event = $this->get('eventService')->updateUserEvent($eventId, $this->getUser(), $request);

        $form = $this->createForm(new CreateEventFormType(), $event);
        $this->get('eventService')->handleFormRequest($form, $event, $request, $this->getUser(),
            'Renginys sėkmingai išsaugotas!');
        return $this->render('AtotrukisMainBundle:Event:editEvent.html.twig', array(
            'form' => $form->createView(),
            'event' => $event
        ));
    }

    public function getEventAction()
    {
        return $this->render('AtotrukisMainBundle:Event:oneEvent.html.twig', array());
    }

    public function getSearchResultAction()
    {
        return $this->render('AtotrukisMainBundle:Event:searchEvents.html.twig', array());
    }

    public function getUser()
    {
        $user = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
            ->findOneById($this->get('security.context')->getToken()->getUser()->getId());

        return $user;
    }

    public function attendAction(Request $request){
        $eventId = $request->request->get('eventId', 'error');
        $event = $this->getDoctrine()->getRepository('AtotrukisMainBundle:Event')
                ->findOneById($eventId);
        $user = $this->getUser();
        $this->get('eventService')->attendEvent($event, $user);
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => $eventId));
        }
    }
}
