<?php

namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;

class HomePageService{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEvents() {
        $rep = $this->em->getRepository('AtotrukisMainBundle:Event');
        $qb = $rep->createQueryBuilder('e')
            ->select('e')
            ->where('e.startDate >= :today')
            ->setParameter('today', new \DateTime());
        return $qb->getQuery()->getResult();
    }

}