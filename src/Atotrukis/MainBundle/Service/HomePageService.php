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
        $rep = $this->entityManager->getRepository('AtotrukisMainBundle:Event');
        $queryBuilder = $rep->createQueryBuilder('e')
            ->select('e')
            ->where('e.startDate >= :today')
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