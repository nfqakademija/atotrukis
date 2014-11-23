<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Atotrukis\MainBundle\Entity\Event;
use Atotrukis\MainBundle\Form\Type\CreateEventFormType;
use Atotrukis\MainBundle\Form\Type\SearchFormType;

class EventController extends Controller
{
    /**
     * creates new event
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createEventAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm(new CreateEventFormType(), $event);

        if ($this->get('eventService')->createEvent($event, $form, $request, $this->getUser())) {
            return $this->redirect($this->generateUrl('my_events'));
        }
        return $this->render('AtotrukisMainBundle:Event:addEvent.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * reads events of a user
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readUserEventsAction(Request $request)
    {

        $userEvents = $this->get('eventService')->readUserEvents($this->getUser(), $request);

        return $this->render('AtotrukisMainBundle:Event:myEvents.html.twig', array('events' => $userEvents));

    }

    /**
     * deletes user's event
     *
     * @param $eventId (int)
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteMyEventAction($eventId, Request $request)
    {
        $this->get('eventService')->deleteUserEvent($eventId, $this->getUser(), $request);
        return $this->redirect($this->generateUrl('my_events'));
    }

    /**
     *
     *
     * @param Request $request
     * @param $eventId (int)
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editMyEventAction(Request $request, $eventId)
    {

        $event = $this->get('eventService')->updateUserEvent($eventId, $this->getUser(), $request);

        $form = $this->createForm(new CreateEventFormType(), $event);
        $update = $this->get('eventService')
            ->handleFormRequest(
                $form,
                $event,
                $request,
                $this->getUser(),
                'Renginys sėkmingai išsaugotas!'
            );

        if ($update) {
            return $this->redirect($this->generateUrl('my_events'));
        }
        return $this->render('AtotrukisMainBundle:Event:editEvent.html.twig', array(
            'form' => $form->createView(),
            'event' => $event
        ));
    }

    /**
     * get events from search results
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSearchResultAction(Request $request)
    {
        $form = $this->createForm(new SearchFormType());

        $response = $this->get('searchService')->handleFormRequest($form, $request, $this->getUser());
        if ($response['formIsValid']) {
            return $this->render('AtotrukisMainBundle:Event:searchResults.html.twig', array(
                'events' => $response['searchResult']
            ));
        }
        return $this->render('AtotrukisMainBundle:Event:searchEvents.html.twig', array(
            'search' => $form->createView(),
        ));


    }

    /**
     * @return bool|\Atotrukis\MainBundle\Entity\User
     */
    public function getUser()
    {
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
                ->findOneById($this->get('security.context')->getToken()->getUser()->getId());
            return $user;
        }
        return false;
    }
}
