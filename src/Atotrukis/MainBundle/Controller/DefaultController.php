<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder()
            ->select('e')
            ->from('AtotrukisMainBundle:Event', 'e')
            ->where('e.startDate >= :today')
            ->setParameter('today', new \DateTime())
        ;
        $events = $qb->getQuery()->getResult();

        if (!$events) {
            //TODO not a solution
           // throw $this->createNotFoundException('Nėra nei vieno renginio')
        }

        $date = $this->get('dateFormatService')->dateArray($events);

        // Pagination
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb,
            $this->get('request')->query->get('puslapis', 1)/*page number*/,
            8/*limit per page*/
        );

        return $this->render('AtotrukisMainBundle:Default:index.html.twig', array(
            'date' => $date,
            'pagination' => $pagination
        ));

    }


    public function ShowEventAction($id)
    {
        // Counting attending people
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder()
            ->select('count(e)')
            ->from('AtotrukisMainBundle:Event', 'e')
            ->innerJoin('e.usersAttending', 'att', 'WITH', 'e.id = att.eventId')
            ->where('e.id = :id')
            ->setParameter('id', $id)
        ;
        $attending = $qb->getQuery()->getSingleScalarResult();


        // Getting event data from id
        $event = $this->get('doctrine')->getManager()->getRepository('AtotrukisMainBundle:Event')->find($id);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        return $this->render('AtotrukisMainBundle:Default:showEvent.html.twig', array(
            'event' => $event, 'attending'=> $attending
        ));
    }


}
