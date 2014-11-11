<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Atotrukis\MainBundle\Entity\UserAttending;

class DefaultController extends Controller
{

    public function indexAction()
    {
        // Changing date format to lithuanian
        function changeDate($time){
            $date = "";
            if ($time->format("Y-m-d") == (new \DateTime())->format("Y-m-d")) {
                $date .= "Šiandien ";
            } elseif($time->format("Y-m-d") == (new \DateTime("tomorrow"))->format("Y-m-d")) {
                $date .= "Rytoj ";
            } else {
                $mon = $time->format('n');
                $months = array("Sausio", "Vasario", "Kovo", "Balandžio", "Gegužės", "Birželio",
                    "Liepos", "Rugpjūčio", "Rugsėjo", "Spalio", "Lapkričio", "Gruodžio");
                if ($time->format('Y') != (new \DateTime())->format('Y')) {
                    $date .= $time->format('Y \m. ');
                }
                $date .= $months[$mon - 1];
                $date .= $time->format(' j \d. ');
            }
            $date .= $time->format("H:i");
            return $date;
        }


        // Getting city from ip address
//        $ip = $_SERVER['REMOTE_ADDR'];
//        $json = file_get_contents("http://ipinfo.io/");
//        $details = json_decode($json);
//        if (!$details->city) {
//            $json = file_get_contents("http://ipinfo.io/$ip");
//            $details = json_decode($json);
//        }
//        $city = $details->city;


        // Searching events according to city
        $em = $this->getDoctrine()->getManager();

//        $qb = $em->createQueryBuilder()
//            ->select('e')
//            ->from('AtotrukisMainBundle:Event', 'e')
//            ->innerJoin('e.city', 'c', 'WITH', 'e.city = c.id')
//            ->where('e.startDate >= :today')
//            ->andWhere('c.name = :city')
//            ->setParameter('today', new \DateTime())
//            ->setParameter('city', $city)
//        ;
//        $events = $qb->getQuery()->getResult();

        $qb = $em->createQueryBuilder()
            ->select('e')
            ->from('AtotrukisMainBundle:Event', 'e')
            ->where('e.startDate >= :today')
            ->setParameter('today', new \DateTime())
        ;
        $events = $qb->getQuery()->getResult();

        if (!$events) {
            // if city isn't got
            $qb = $em->createQueryBuilder()
                ->select('e')
                ->from('AtotrukisMainBundle:Event', 'e')
                ->where('e.startDate >= :today')
                ->setParameter('today', new \DateTime())
            ;
            $events = $qb->getQuery()->getResult();

            if (!$events) {
                throw $this->createNotFoundException('Nėra nei vieno renginio');
            }
        }


        // Changing date format to lithuanian
        $date = [];
        foreach ($events as $e) {
            $date[$e->getId()] = changeDate($e->getStartDate());
        }


        // Pagination
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb,
            $this->get('request')->query->get('puslapis', 1)/*page number*/,
            8/*limit per page*/
        );


        return $this->render('AtotrukisMainBundle:Default:index.html.twig', array(
            'date' => $date, 'pagination' => $pagination
        ));

    }


    public function ShowEventAction($id)
    {
        // Adding attending person
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository('AtotrukisMainBundle:User')->find(1);
//        $event = $em->getRepository('AtotrukisMainBundle:Event')->find(1075);
//        $att = new UserAttending();
//        $att->setUserId($user);
//        $att->setEventId($event);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($att);
//        $em->flush();


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
