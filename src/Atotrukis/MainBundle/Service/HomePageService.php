<?php

namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\SecurityContext;

class HomePageService
{

    protected $entityManager;
    protected $requestStack;
    protected $securityContext;
    protected $eventService;

    /**
     * @param EntityManager $entityManager
     * @param RequestStack $requestStack
     * @param SecurityContext $securityContext
     * @param EventService $eventService
     */
    public function __construct(EntityManager $entityManager, RequestStack $requestStack, SecurityContext $securityContext, EventService $eventService)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->securityContext = $securityContext;
        $this->eventService = $eventService;
    }

    /**
     * @return array of events which takes place later than current time
     */
    public function getEvents()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('event')
            ->from('AtotrukisMainBundle:Event', 'event')
            ->where('event.endDate >= :today')
            ->setParameter('today', new \DateTime());
        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return array amIAttending of boolean values which shows registered user is attending in event or
     * not and array attending of count of each event attending people
     *
     */
    public function getAttending()
    {
        $events = $this->getEvents();
        $amIAttending = [];
        $attending = [];
        foreach ($events as $event) {
            $eventId = $event->getId();
            $attending[$eventId] = $this->eventService->getAttending($eventId);
            if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
                $user = $this->securityContext->getToken()->getUser()->getId();
                $amIAttending[$eventId] = $this->eventService->isUserAttendingEvent($eventId, $user);
            }
        }
        if (!$events) {
            $this->addFlash($this->requestStack->getCurrentRequest(), 'Nėra jokių renginių!', 'danger');
        }
        return array($amIAttending, $attending);
    }

    /**
     * adds flashBag with status and message
     *
     * @param $request
     * @param $message
     * @param $status
     */
    public function addFlash($request, $message, $status)
    {
        $request->getSession()->getFlashBag()->add($status, $message);
    }

}