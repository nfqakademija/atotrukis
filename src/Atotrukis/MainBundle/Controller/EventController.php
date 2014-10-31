<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Atotrukis\MainBundle\Entity\Event;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Atotrukis\MainBundle\Entity\City;
use Doctrine\ORM\EntityRepository;
class EventController extends Controller
{
    public function createAction(Request $request)
    {

        $event = new Event();

        $form = $this->createFormBuilder($event)
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('map', 'text')
            ->add('city', 'entity', array(
                'class' => 'AtotrukisMainBundle:City',
                'property' => 'name',
                'empty_value' => 'Pasirinkite miestą',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->addOrderBy('c.priority', 'ASC')
                        ->addOrderBy('c.name', 'ASC');
                },
            ))
            ->add('save', 'submit', array('label' => 'Sukurti'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($request->isMethod('POST')) {

                $city = $this->getDoctrine()->getRepository('AtotrukisMainBundle:City')
                    ->findOneById($form['city']->getData());

                $event->setName($form['name']->getData());
                $event->setDescription($form['description']->getData());
                $event->setStartDate($form['startDate']->getData());
                $event->setEndDate($form['endDate']->getData());
                $event->setMap($form['map']->getData());
                $event->setCity($city);

                $user = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
                    ->findOneById($this->get('security.context')->getToken()->getUser()->getId());
                $event->setCreatedBy($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('my_events'));
        }
        return $this->render('AtotrukisMainBundle:Event:addEvent.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function readMyEventsAction()
    {
        $user = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
            ->findOneById($this->get('security.context')->getToken()->getUser()->getId());
        $event = $this->getDoctrine()
            ->getRepository('AtotrukisMainBundle:Event')
            ->findByCreatedBy($user);
        if (!$event) {
            throw $this->createNotFoundException(
                'You have no events'
            );
        }

        return $this->render('AtotrukisMainBundle:Event:myEvents.html.twig', array('events' => $event));
    }

    public function deleteMyEventAction($id)
    {
        self::checkEventOwner('delete', $id);

        $event = $this->getDoctrine()
            ->getRepository('AtotrukisMainBundle:Event')
            ->findOneById($id);
        if (!$event) {
            throw $this->createNotFoundException(
                'No event found for id '.$id
            );
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();

        return $this->redirect($this->generateUrl('my_events'));
    }

    public function editMyEventAction(Request $request, $id)
    {
//        $currentUser = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
//            ->findOneById($this->get('security.context')->getToken()->getUser()->getId());
//
//        $event = $this->getDoctrine()
//            ->getRepository('AtotrukisMainBundle:Event')
//            ->findOneById($id);
//
//        if($event->getCreatedBy() != $currentUser)
//        {
//            throw $this->createAccessDeniedException(
//                'You have no permissions to edit this event'
//            );
//        }

        self::checkEventOwner('edit', $id);

        $event->setName($event->getName());
        $event->setDescription($event->getDescription());
        $event->setStartDate($event->getStartDate());
        $event->setEndDate($event->getEndDate());
        $event->setMap($event->getMap());
        $event->setCity($event->getCity());

        $form = $this->createFormBuilder($event)
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('map', 'text')
            ->add('city', 'entity', array(
                'class' => 'AtotrukisMainBundle:City',
                'property' => 'name',
                'empty_value' => 'Pasirinkite miestą',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->addOrderBy('c.priority', 'ASC')
                        ->addOrderBy('c.name', 'ASC');
                },
                'preferred_choices' => array($event->getCity()),
            ))
            ->add('save', 'submit', array('label' => 'Sukurti'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($request->isMethod('POST')) {

                $event = $this->getDoctrine()->getRepository('AtotrukisMainBundle:Event')->findOneById($id);
                if (!$event) {
                    throw $this->createNotFoundException(
                        'No event found for id '.$id
                    );
                }

                $event->setName($form['name']->getData());
                $event->setDescription($form['description']->getData());
                $event->setStartDate($form['startDate']->getData());
                $event->setEndDate($form['endDate']->getData());
                $event->setMap($form['map']->getData());
                $event->setCity($form['city']->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();

            }

            return $this->redirect($this->generateUrl('my_events'));
        }


        return $this->render('AtotrukisMainBundle:Event:editEvent.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function checkEventOwner($action, $id)
    {
        $currentUser = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
            ->findOneById($this->get('security.context')->getToken()->getUser()->getId());

        $event = $this->getDoctrine()
            ->getRepository('AtotrukisMainBundle:Event')
            ->findOneById($id);

        if($event->getCreatedBy() != $currentUser)
        {
            throw $this->createAccessDeniedException(
                'You have no permissions to '.$action.' this event'
            );
        }

    }
}
