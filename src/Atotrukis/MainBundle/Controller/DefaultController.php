<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Atotrukis\MainBundle\Entity\Event;
use Atotrukis\MainBundle\Entity\City;

class DefaultController extends Controller
{

    public function indexAction()
    {
        // Generating data------------------------------------
        // Generating cities
//        $city = new City(); $city->setName("Kaunas"); $city->setPriority(1); $em = $this->getDoctrine()->getManager(); $em->persist($city); $em->flush();
//        $city = new City(); $city->setName("Vilnius"); $city->setPriority(1); $em = $this->getDoctrine()->getManager(); $em->persist($city); $em->flush();
//        $city = new City(); $city->setName("Klaipėda"); $city->setPriority(1); $em = $this->getDoctrine()->getManager(); $em->persist($city); $em->flush();
//        $city = new City(); $city->setName("Alytus"); $city->setPriority(1); $em = $this->getDoctrine()->getManager(); $em->persist($city); $em->flush();
//        $city = new City(); $city->setName("Šiauliai"); $city->setPriority(1); $em = $this->getDoctrine()->getManager(); $em->persist($city); $em->flush();
//        $city = new City(); $city->setName("Panevėžys"); $city->setPriority(1); $em = $this->getDoctrine()->getManager(); $em->persist($city); $em->flush();

        // Generating events
//        for ($i = 0; $i < 10; $i++) {
//            $names = array("Koncertas", "Miesto šventė", "Parduotuvės atidarymas", "Futbolo varžybos", "Krepšinio varžybos",
//                "Šokiai", "Paroda", "Karaoke", "Protmūšis", "Spektaklis", "Paskaita", "Festivalis", "Muzikos vakaras");
//            $descriptions = array("Labai įdomus renginys", "Linksmas laiko praleidimas", "Įdomu", "Smagu", "Čia toks labai įdomus renginys, kuriame pamatysite visokių įdomių dalykų, kurie bus labai smagūs ir linksmi.");
//            $em = $this->getDoctrine()->getManager();
//            $cities = $em->getRepository('AtotrukisMainBundle:City')->findAll();
//            $dates = array("2014-11-20 15:00", "2014-12-01 18:00", "2015-01-01 20:20", "2014-12-12 15:00", "2015-01-15 20:00");
//            $event = new Event();
//            $event->setName($names[array_rand($names, 1)]);
//            $event->setDescription($descriptions[array_rand($descriptions, 1)]);
//            $event->setStartDate(new \DateTime($dates[array_rand($dates, 1)]));
//            $event->setEndDate(new \DateTime("2016-10-10"));
//            $event->setCity($cities[array_rand($cities, 1)]);
//            $event->setMap("https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2293.942924457549!2d23.957789!3d54.90392399999999!3m2!1i1024!2i768!4f13.1!5e0!3m2!1slt!2slt!4v1414796027316");
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($event);
//            $em->flush();
//        }

        // Deleting all cities
//        $em = $this->getDoctrine()->getManager();
//        $query = $em->createQuery(
//            'Delete
//            FROM AtotrukisMainBundle:City');
//        $query->getResult();

        // Deleting all events
//        $em = $this->getDoctrine()->getManager();
//        $query = $em->createQuery(
//            'Delete
//            FROM AtotrukisMainBundle:Event');
//        $query->getResult();

        //----------------------------------------------------


        // -----------indexAction code------------------------

        // Changing date format to lithuanian
        function changeDate($time){

            $mon = $time->format('n');
            $months = array("Sausio", "Vasario", "Kovo", "Balandžio", "Gegužės", "Birželio",
                "Liepos","Rugpjūčio", "Rugsėjo","Spalio", "Lapkričio", "Gruodžio");
            $date = "";
            if ($time->format('Y') != (new \DateTime())->format('Y')) {
                $date .= $time->format('Y \m. ');
            }
            $date .= $months[$mon-1];
            $date .= $time->format(' j \d. H:i');
            return $date;

        }

        // Getting city from ip address
        function ip_details($ip) {
            $json = file_get_contents("http://ipinfo.io/");
            $details = json_decode($json);
            return $details;
        }
        $details = ip_details($_SERVER['REMOTE_ADDR']);
        $city = $details->city;

        // Searching events according to city
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT e
            FROM AtotrukisMainBundle:Event e, AtotrukisMainBundle:City c
            WHERE e.startDate > :today and e.city = c.id and c.name = :city
            ')
            ->setParameter('today', new \DateTime())
            ->setParameter('city', $city);

        $events = $query->getResult();

        $date = [];
        foreach ($events as $e) {
            $date[$e->getId()] = changeDate($e->getStartDate());
        }

        if (!$events) {
            throw $this->createNotFoundException('Nėra nei vieno renginio');
        }

        return $this->render('AtotrukisMainBundle:Default:index.html.twig', array(
            'events' => $events, 'date' => $date
        ));
    }

    public function ShowEventAction($id)
    {
        $event = $this->get('doctrine')->getManager()->getRepository('AtotrukisMainBundle:Event')->find($id);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        return $this->render('AtotrukisMainBundle:Default:showEvent.html.twig', array(
            'event' => $event
        ));
    }


}
