<?php
namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Class EventService
 * @package Atotrukis\MainBundle\Service
 */
class CommentsService
{
    protected $entityManager;
    protected $eventService;

    /**
     * @param EntityManager $entityManager
     * @param EventService $eventService
     */
    public function __construct(EntityManager $entityManager, EventService $eventService)
    {
        $this->entityManager = $entityManager;
        $this->eventService = $eventService;
    }

    /**
     * checks if honeypot is empty
     * @param $pot
     * @return bool
     */
    public function validateHoneyPot($pot)
    {
        if(!empty($pot)) {
            return false;
        }
        return true;
    }
    /**
     * creates comment in event
     * @param $comment
     * @param $form
     * @param $request
     * @param $user
     * @return mixed
     */
    public function createComment($comment, $form, $request, $user)
    {
        return $this->handleFormRequest($form, $comment, $request, $user);
    }

    /**
     * gets comments in event
     * @param $eventID
     * @param $request
     * @return mixed
     */
    public function readEventComments($eventID, $request)
    {
        $comments = $this->entityManager
            ->getRepository('AtotrukisMainBundle:EventComments')
            ->findByEventI($eventID);
        if (!$comments) {
            $this->addFlash($request, 'Jūs neturite jokių renginių!', 'danger');
        }
        return $comments;
    }

    public function handleFormRequest($form, $comment, $request, $user)
    {
        $form->handleRequest($request);
        $entityManager = $this->entityManager;
        if ($form->isValid()) {
            if ($request->isMethod('POST')) {
                $this->setEventValues($form, $comment, $user);

                $entityManager->flush();

                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * @param $form
     * @param $comment
     * @param $user
     */
    public function setEventValues($form, $comment, $user)
    {
        $comment->setComment($form['comment']->getData());
        $comment->setUserId($user);
        $event = $this->eventService->getEventById($form['eventId']->getData());
        $comment->setEventId($event);
        $comment->setCreatedOn(new \DateTime("now"));
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    /**
     * @param $eventId
     * @return array
     */
    public function getEventComments($eventId)
    {
        $results = $this->entityManager->getRepository("AtotrukisMainBundle:EventComments")->
            findBy(array('eventId' => $eventId),array('createdOn' => 'DESC'));
        $comments = array();
        foreach($results as $result){
            $comment = $result->getComment();
            $createdDate = $result->getCreatedOn();
            $user = $result->getUserId()->getName();
            $comments[] = array(
                'user' => $user,
                'date' => $createdDate,
                'comment' => $comment,
            );
           /* $user = $this->entityManager->getRepository("AtotrukisMainBundle:User")->
            findOneBy(array('id' => $, 'eventId' => $eventId));*/
        }
        return $comments;
    }

}
