<?php

namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;

class HomePageService
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getEvents()
    {
        $rep = $this->em->getRepository('AtotrukisMainBundle:Event');
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