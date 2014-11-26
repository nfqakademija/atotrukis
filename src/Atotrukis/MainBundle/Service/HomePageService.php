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

    public function __construct(EntityManager $entityManager, RequestStack $requestStack, SecurityContext $securityContext, EventService $eventService)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->securityContext = $securityContext;
        $this->eventService = $eventService;
    }

    public function getEvents()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('event')
            ->from('AtotrukisMainBundle:Event', 'event')
            ->where('event.endDate >= :today')
            ->orderBy('event.startDate')
            ->setParameter('today', new \DateTime());
        return $queryBuilder->getQuery()->getResult();
    }

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
        return array($amIAttending, $attending);
    }

    public function paginate($paginator, $max)
    {
        $pagination = $paginator->paginate(
            $this->getEvents(),
            $this->requestStack->getCurrentRequest()->query->get('puslapis', 1), /*page number*/
            $max/*limit per page*/
        );
        return $pagination;
    }

}