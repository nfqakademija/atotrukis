<?php
namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;
use Atotrukis\MainBundle\Entity\EventKeywords;

class EventService
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createEvent($event, $form, $request, $user)
    {
        self::handleFormRequest($form, $event, $request, $user, 'Renginys sėkmingai sukurtas!');
    }
    public function readUserEvents($userId, $request)
    {

        $event = $this->entityManager
            ->getRepository('AtotrukisMainBundle:Event')
            ->findByCreatedBy($userId);
        if (!$event) {
            $this->addFlash($request, 'Jūs neturite jokių renginių!', 'danger');
        }
        return $event;
    }
    public function deleteUserEvent($eventId, $user, $request)
    {
        self::checkEventOwner('edit', $eventId, $user);

        $event = $this->entityManager->getRepository('AtotrukisMainBundle:Event')->findOneById($eventId);
        if (!$event) {
            $this->addFlash($request, 'Renginys nerastas!', 'danger');
        }
        $entityManager = $this->entityManager;
        $entityManager->remove($event);
        $entityManager->flush();
        $this->addFlash($request, 'Renginys sėkmingai ištrintas!', 'success');
    }
    public function updateUserEvent($eventId, $user)
    {
        $event = $this->entityManager->getRepository('AtotrukisMainBundle:Event')->findOneById($eventId);
        self::checkEventOwner('edit', $eventId, $user);

        $event->setName($event->getName());
        $event->setDescription($event->getDescription());
        $event->setStartDate($event->getStartDate());
        $event->setEndDate($event->getEndDate());
        $event->setMap($event->getMap());
        $event->setCity($event->getCity());

        return $event;
    }

    public function checkEventOwner($action, $eventId, $user)
    {
        $event = $this->entityManager->getRepository('AtotrukisMainBundle:Event')->findOneById($eventId);

        if ($event->getCreatedBy() != $user) {
            throw $this->createAccessDeniedException(
                'You have no permissions to '.$action.' this event'
            );
        }

    }
    public function handleFormRequest($form, $event, $request, $user, $message)
    {
        $form->handleRequest($request);
        $entityManager = $this->entityManager;
        if ($form->isValid()) {
            if ($request->isMethod('POST')) {

                $this->setEventValues($form, $event, $user, $entityManager);
                $this->removeOldKeywords($event, $entityManager);
                $this->processNewKeywords($form, $event, $entityManager);

                $entityManager->flush();

                $this->addFlash($request, $message, 'success');
            }
        }

    }

    /**
     * @param $form
     * @param $event
     * @param $user
     * @param $entityManager
     */
    public function setEventValues($form, $event, $user, $entityManager)
    {
        $event->setName($form['name']->getData());
        $event->setDescription($form['description']->getData());
        $event->setStartDate($form['startDate']->getData());
        $event->setEndDate($form['endDate']->getData());
        $event->setMap($form['map']->getData());
        $event->setCity($this->getCity($form));
        $event->setCreatedBy($user);

        $entityManager->persist($event);
    }

    /**
     * @param $form
     * @return mixed
     */
    public function getCity($form)
    {
        return $this->entityManager->getRepository('AtotrukisMainBundle:City')
            ->findOneById($form['city']->getData());
    }

    /**
     * @param $event
     * @param $entityManager
     */
    public function removeOldKeywords($event, $entityManager)
    {
        $oldKeywords = $this->entityManager->getRepository('AtotrukisMainBundle:EventKeywords')->findByEventId($event);

        foreach ($oldKeywords as $oldKeyword) {
            $entityManager->remove($oldKeyword);
        }
    }

    /**
     * @param $form
     * @param $event
     * @param $entityManager
     */
    public function processNewKeywords($form, $event, $entityManager)
    {
        $keywords = $this->explodeKeywords($form);

        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            $this->PersistKeywords($event, $entityManager, $keyword);
        }
    }

    /**
     * @param $event
     * @param $entityManager
     * @param $keyword
     */
    public function PersistKeywords($event, $entityManager, $keyword)
    {
        $eventKeywords = new EventKeywords();
        $eventKeywords->setKeyword($keyword);
        $eventKeywords->setEventId($event);
        $entityManager->persist($eventKeywords);
    }

    /**
     * @param $request
     * @param $message
     * @param $status
     */
    public function addFlash($request, $message, $status)
    {
        $request->getSession()->getFlashBag()->add($status, $message);
    }

    public function getAttending($id){
        $rep = $this->entityManager->getRepository('AtotrukisMainBundle:Event');
        $qb = $rep->createQueryBuilder('e')
            ->select('count(e)')
            ->innerJoin('e.usersAttending', 'att', 'WITH', 'e.id = att.eventId')
            ->where('e.id = :id')
            ->setParameter('id', $id)
        ;
        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @param $form
     * @return array|mixed
     */
    public function explodeKeywords($form)
    {
        $keywords = $form['keywords']->getData();
        $keywords = explode(" ", $keywords);
        return $keywords;
    }

}