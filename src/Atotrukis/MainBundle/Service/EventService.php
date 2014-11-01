<?php
namespace Atotrukis\MainBundle\Service;
use Doctrine\ORM\EntityManager;

class EventService{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createEvent($event, $form, $request, $user)
    {
        self::handleFormRequest($form, $event, $request, $user, 'Renginys sėkmingai sukurtas!');
    }
    public function readUserEvents($userId){

        $event = $this->em
            ->getRepository('AtotrukisMainBundle:Event')
            ->findByCreatedBy($userId);
        if (!$event) {
            throw $this->createNotFoundException(
                'You have no events'
            );
        }
        return $event;
    }
    public function deleteUserEvent($id, $user, $request)
    {
        self::checkEventOwner('edit', $id, $user);

        $event = $this->em->getRepository('AtotrukisMainBundle:Event')->findOneById($id);
        if (!$event) {
            throw $this->createNotFoundException(
                'No event found for id '.$id
            );
        }
        $em = $this->em;
        $em->remove($event);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success', 'Renginys sėkmingai ištrintas!');
    }
    public function updateUserEvent($id, $user, $request)
    {
        $event = $this->em->getRepository('AtotrukisMainBundle:Event')->findOneById($id);

        self::checkEventOwner('edit', $id, $user);

        $event->setName($event->getName());
        $event->setDescription($event->getDescription());
        $event->setStartDate($event->getStartDate());
        $event->setEndDate($event->getEndDate());
        $event->setMap($event->getMap());
        $event->setCity($event->getCity());



        return $event;
    }

    public function checkEventOwner($action, $id, $user)
    {
        $event = $this->em->getRepository('AtotrukisMainBundle:Event')->findOneById($id);

        if($event->getCreatedBy() != $user)
        {
            throw $this->createAccessDeniedException(
                'You have no permissions to '.$action.' this event'
            );
        }

    }
    public function handleFormRequest($form, $event, $request, $user, $message)
    {
        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($request->isMethod('POST')) {

                $city = $this->em->getRepository('AtotrukisMainBundle:City')
                    ->findOneById($form['city']->getData());

                $event->setName($form['name']->getData());
                $event->setDescription($form['description']->getData());
                $event->setStartDate($form['startDate']->getData());
                $event->setEndDate($form['endDate']->getData());
                $event->setMap($form['map']->getData());
                $event->setCity($city);
                $event->setCreatedBy($user);

                $em = $this->em;
                $em->persist($event);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', $message);
            }
        }

    }

}