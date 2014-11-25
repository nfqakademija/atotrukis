<?php

namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;

class HomePageService
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
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

    public function paginate($paginator, $request, $max)
    {
        $pagination = $paginator->paginate(
            $this->getEvents(),
            $request, /*page number*/
            $max/*limit per page*/
        );
        return $pagination;
    }

}