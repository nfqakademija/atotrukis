<?php
namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;
use Atotrukis\MainBundle\Entity\EventKeywords;
use Atotrukis\MainBundle\Entity\UserAttending;

/**
 * Class EventService
 * @package Atotrukis\MainBundle\Service
 */
class EventService
{

    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * creates event and returns true if the form is valid
     *
     * @param $event \Atotrukis\MainBundle\Entity\Event
     * @param $form \Atotrukis\MainBundle\Form\Type\CreateEventFormType
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @param $user \Atotrukis\MainBundle\Entity\User
     * @return bool
     */
    public function createEvent($event, $form, $request, $user)
    {
        return $this->handleFormRequest($form, $event, $request, $user, 'Renginys sėkmingai sukurtas!');
    }

    /**
     * @param $user \Atotrukis\MainBundle\Entity\User
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @return \Atotrukis\MainBundle\Entity\Event array
     */
    public function readUserEvents($user, $request)
    {

        $event = $this->entityManager
            ->getRepository('AtotrukisMainBundle:Event')
            ->findByCreatedBy($user);
        if (!$event) {
            $this->addFlash($request, 'Jūs neturite jokių renginių!', 'danger');
        }
        return $event;
    }

    /**
     * deletes user event
     *
     * @param $eventId int
     * @param $user \Atotrukis\MainBundle\Entity\User
     * @param $request \Symfony\Component\HttpFoundation\Request
     */
    public function deleteUserEvent($eventId, $user, $request)
    {
        $this->checkEventOwner('edit', $eventId, $user);

        $event = $this->entityManager->getRepository('AtotrukisMainBundle:Event')->findOneById($eventId);
        if (!$event) {
            $this->addFlash($request, 'Renginys nerastas!', 'danger');
        }
        $entityManager = $this->entityManager;
        $entityManager->remove($event);
        $entityManager->flush();
        $this->addFlash($request, 'Renginys sėkmingai ištrintas!', 'success');
    }

    /**
     * sets current event's values for a form
     *
     * @param $eventId int
     * @param $user \Atotrukis\MainBundle\Entity\User
     * @return \Atotrukis\MainBundle\Entity\Event
     */
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

    /**
     * @param $action String edit/delete
     * @param $eventId int
     * @param $user \Atotrukis\MainBundle\Entity\User
     */
    public function checkEventOwner($action, $eventId, $user)
    {
        $event = $this->entityManager->getRepository('AtotrukisMainBundle:Event')->findOneById($eventId);

        if ($event->getCreatedBy() != $user) {
            throw $this->createAccessDeniedException(
                'You have no permissions to '.$action.' this event'
            );
        }

    }

    /**
     * @param $form \Atotrukis\MainBundle\Form\Type\CreateEventFormType
     * @param $event \Atotrukis\MainBundle\Entity\Event
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @param $user \Atotrukis\MainBundle\Entity\User
     * @param $message String for a flash
     * @return bool true if form is valid
     */
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
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * sets updated values for event
     *
     * @param $form \Atotrukis\MainBundle\Form\Type\CreateEventFormType
     * @param $event \Atotrukis\MainBundle\Entity\Event
     * @param $user \Atotrukis\MainBundle\Entity\User
     */
    public function setEventValues($form, $event, $user)
    {
        $event->setName($form['name']->getData());
        $event->setDescription($form['description']->getData());
        $event->setStartDate($form['startDate']->getData());
        $event->setEndDate($form['endDate']->getData());
        $event->setMap($form['map']->getData());
        $event->setCity($form['city']->getData());
        $event->setCreatedBy($user);

        $this->entityManager->persist($event);
    }

    /**
     * when updating event removes old keywords
     *
     * @param $eventId int
     */
    public function removeOldKeywords($eventId)
    {
        $oldKeywords = $this->entityManager
            ->getRepository('AtotrukisMainBundle:EventKeywords')
            ->findByEventId($eventId);

        foreach ($oldKeywords as $oldKeyword) {
            $this->entityManager->remove($oldKeyword);
        }
    }

    /**
     * @param $form \Atotrukis\MainBundle\Form\Type\CreateEventFormType
     * @param $event \Atotrukis\MainBundle\Entity\Event
     */
    public function processNewKeywords($form, $event)
    {
        $keywords = array_merge(
            $this->explodeKeywords($form['keywords']->getData()),
            $this->explodeKeywords($form['name']->getData())
        );

        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            $this->persistKeywords($event, $keyword);
        }
    }

    /**
     * @param $event \Atotrukis\MainBundle\Entity\Event
     * @param $keyword String
     */
    public function persistKeywords($event, $keyword)
    {
        $eventKeywords = new EventKeywords();
        $eventKeywords->setKeyword($keyword);
        $eventKeywords->setEventId($event);
        $this->entityManager->persist($eventKeywords);
    }

    /**
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @param $message String
     * @param $status String success, danger etc.
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
     * set user as attending event
     * @param $eventId
     * @param $userId
     */
    public function attendEvent($eventId, $userId)
    {
        $userAttending = new UserAttending();
        $userAttending->setUserId($userId);
        $userAttending->setEventId($eventId);
        $this->entityManager->persist($userAttending);
        $this->entityManager->flush();
    }

    /**
     * removes user from attending event
     * @param $eventId
     * @param $userId
     */
    public function leaveEvent($eventId, $userId)
    {
        $userAttending = $this->entityManager->getRepository("AtotrukisMainBundle:UserAttending")->
                         findOneBy(array('eventId' => $eventId, 'userId' => $userId));
        $entityManager = $this->entityManager;
        $entityManager->remove($userAttending);
        $entityManager->flush();
    }

    /**
     * checks if user attends event
     * @param $eventId
     * @param $userId
     * @return bool
     */
    public function isUserAttendingEvent($eventId, $userId)
    {
        $event = $this->entityManager->getRepository("AtotrukisMainBundle:UserAttending")->
        findOneBy(array('userId' => $userId, 'eventId' => $eventId));
        if ($event != null) {
            return true;
        }
        return false;
    }

    /**
     * @param $form \Atotrukis\MainBundle\Form\Type\CreateEventFormType
     * @return array of keywords
     */
    public function explodeKeywords($keywordsString)
    {
        $keywords = explode(" ", $keywordsString);
        return $keywords;
    }

    /**
     * gets newest events
     * @param int $start
     * @param int $limit
     * @return array
     */
    public function getNewestEvents($start = 0, $limit = 5)
    {
        $rep = $this->entityManager->getRepository('AtotrukisMainBundle:Event');
        $queryBuilder = $rep->createQueryBuilder('e')
            ->select('e')
            ->orderBy('e.createdOn', 'DESC')
            ->setFirstResult($start)
            ->setMaxResults($start + $limit);
        $results = $queryBuilder->getQuery()->getArrayResult();
        return $results;
    }

    public function getEventById($eventId)
    {
        $event = $this->entityManager->getRepository('AtotrukisMainBundle:Event')
            ->findOneById($eventId);
        return $event;
    }

    public function readUserAttendingEvents($user, $request) {
        $event = $this->entityManager
            ->getRepository('AtotrukisMainBundle:UserAttending')
            ->findByUserId($user);

        if (!$event) {
            $this->addFlash($request, 'Kol kas jus nedalyvaujate jokiuose renginiuose.', 'warning');
        }

        return $event;


    }
}