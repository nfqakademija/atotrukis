<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Atotrukis\MainBundle\Entity\Event;

class ShowEventsController extends Controller
{
    public function ShowAllEventsAction()
    {

//        $event = new Event();
//        $event->setName("Renginys");
//        $event->setDescription("Labai šaunus renginys. Jame galima labai linksmai praleisti laiką");
//        $event->setStartDate(new \DateTime("now"));
//        $event->setEndDate(new \DateTime("now"));
//        $event->setMap("https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2293.942924457549!2d23.957789!3d54.90392399999999!3m2!1i1024!2i768!4f13.1!5e0!3m2!1slt!2slt!4v1414796027316");
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($event);
//        $em->flush();


        $events = $this->get('doctrine')->getManager()->getRepository('AtotrukisMainBundle:Event')->findAll();

        if (!$events) {
            throw $this->createNotFoundException('Nėra nei vieno įvykio');
        }

        return $this->render('AtotrukisMainBundle:ShowEvents:index.html.twig', array(
            'events' => $events
        ));
    }

    public function ShowEventAction($id)
    {
        $event = $this->get('doctrine')->getManager()->getRepository('AtotrukisMainBundle:Event')->find($id);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        return $this->render('AtotrukisMainBundle:ShowEvents:ShowEvent.html.twig', array(
            'event' => $event
        ));
    }

}
