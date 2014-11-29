<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Atotrukis\MainBundle\Entity\Event;
use Atotrukis\MainBundle\Form\Type\CreateEventFormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Atotrukis\MainBundle\Form\Type\SearchFormType;
use Symfony\Component\HttpFoundation\Response;

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
        $form = $this->createForm('searchForm');

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

    public function readUserAttendingAction(Request $request) {
        $userAttending = $this->get('eventService')->readUserAttendingEvents($this->getUser(), $request);
        return $this->render(
            'AtotrukisMainBundle:Event:AttendingToEvents.html.twig',
            array(
                'events' => $userAttending,
            )
        );
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
        return null;
    }

    //ajax request method for attending buttons
    //TODO: need to move logic to service
    public function attendAction(Request $request){
        $eventId = $request->request->get('eventId', 'error');
        $event = $this->getDoctrine()->getRepository('AtotrukisMainBundle:Event')
                ->findOneById($eventId);
        $user = $this->getUser();
        $this->get('eventService')->attendEvent($event, $user);
        $newUrl = $url = $this->generateUrl('leave_event');
        $newButton = '
            <button class="btn btn-default attendingButton" type="button">
                Dalyauju
                <span class="glyphicon glyphicon-ok"></span>
                <span class="eventID">'.$eventId.'</span>
                <span class="jsRoute">'.$newUrl.'</span></button>';
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => $newButton));
        }
    }

    //ajax request method for leaving buttons
    //TODO: need to move logic to service
    public function leaveAction(Request $request)
    {
        $eventId = $request->request->get('eventId', 'error');
        $user = $this->getUser();
        $this->get('eventService')->leaveEvent($eventId, $user->getId());
        $newUrl = $this->generateUrl('attend_event');
        $newButton = '
            <button class="btn btn-default attendButton" type="button">
                Dalyausiu
                <span class="glyphicon glyphicon-thumbs-up"></span>
                <span class="eventID">'.$eventId.'</span>
                <span class="jsRoute">'.$newUrl.'</span></button>';
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => $newButton));
        }
    }
    //ajax request method for attending small buttons
    //TODO: need to move logic to service
    public function attendSmallAction(Request $request){
        $eventId = $request->request->get('eventId', 'error');
        $event = $this->getDoctrine()->getRepository('AtotrukisMainBundle:Event')
            ->findOneById($eventId);
        $user = $this->getUser();
        $this->get('eventService')->attendEvent($event, $user);
        $newUrl = $url = $this->generateUrl('leave_event_sml');
        $newButton = '
            <button class="btn btn-default attendingButton-sml eventBtn" type="button">
                <span class="glyphicon glyphicon-ok"></span>
                <span class="eventID">'.$eventId.'</span>
                <span class="jsRoute">'.$newUrl.'</span></button>';
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => $newButton));
        }
    }

    //ajax request method for leaving small buttons
    //TODO: need to move logic to service
    public function leaveSmallAction(Request $request)
    {
        $eventId = $request->request->get('eventId', 'error');
        $user = $this->getUser();
        $this->get('eventService')->leaveEvent($eventId, $user->getId());
        $newUrl = $this->generateUrl('attend_event_sml');
        $newButton = '
            <button class="btn btn-default attendButton-sml eventBtn" type="button">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                <span class="eventID">'.$eventId.'</span>
                <span class="jsRoute">'.$newUrl.'</span></button>';
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => $newButton));
        }
    }

    /**
     * gets newest events
     * default start offset = 0, limit = 5
     * @return array
     */
    public function getNewestEventsAction()
    {
        $news = $this->get('eventService')->getNewestEvents();
        return $this->render('AtotrukisMainBundle:Default:newEvents.html.twig', array(
            'events' => $news,
        ));
    }
}
