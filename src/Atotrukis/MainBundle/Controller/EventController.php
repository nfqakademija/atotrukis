<?php

namespace Atotrukis\MainBundle\Controller;

use Atotrukis\MainBundle\Form\Type\CreateEventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Atotrukis\MainBundle\Entity\Event;
use Atotrukis\MainBundle\Form\Type\CreateEventFormType;
class EventController extends Controller
{

    public function createEventAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm(new CreateEventFormType(), $event);

        $user = self::getUser();

        $this->get('eventService')->createEvent($event, $form, $request, $user);
        //$request->getSession()->getFlashBag()->add('success', 'Renginys sėkmingai sukurtas!');
        return $this->render('AtotrukisMainBundle:Event:addEvent.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function readUserEventsAction(Request $request)
    {

        $user = self::getUser();

        $userEvents = $this->get('eventService')->readUserEvents($user, $request);

        return $this->render('AtotrukisMainBundle:Event:myEvents.html.twig', array('events' => $userEvents));

    }

    public function deleteMyEventAction($id, Request $request)
    {
        $user = self::getUser();
        $this->get('eventService')->deleteUserEvent($id, $user, $request);
        //$request->getSession()->getFlashBag()->add('success', 'Renginys sėkmingai ištrintas!');
        return $this->redirect($this->generateUrl('my_events'));
    }

    public function editMyEventAction(Request $request, $id)
    {

        $user = self::getUser();
        $event = $this->get('eventService')->updateUserEvent($id, $user, $request);

        $form = $this->createForm(new CreateEventFormType(), $event);
        $this->get('eventService')->handleFormRequest($form, $event, $request, $user, 'Renginys sėkmingai išsaugotas!');
        return $this->render('AtotrukisMainBundle:Event:editEvent.html.twig', array(
            'form' => $form->createView(),
            'event' => $event
        ));
    }

    public function getUser()
    {
        $user = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
            ->findOneById($this->get('security.context')->getToken()->getUser()->getId());

        return $user;
    }
}
