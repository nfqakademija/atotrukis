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
     * @param String $pot
     * @return bool
     */
    public function validateHoneyPot($pot)
    {
        if (!empty($pot)) {
            return false;
        }
        return true;
    }
    /**
     * creates comment in event
     * @param String $comment
     * @param Form $form
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function createComment($comment, $form, $request, $user)
    {
        return $this->handleFormRequest($form, $comment, $request, $user);
    }

    /**
     * gets comments in event
     * @param Event $eventID
     * @param Request $request
     * @return mixed
     */
    public function readEventComments($eventID, $request)
    {
        $comments = $this->entityManager
            ->getRepository('AtotrukisMainBundle:EventComments')
            ->findBy(array('eventId' => $eventID));
        if (!$comments) {
            $this->eventService->addFlash($request, 'Komentarų dar nėra.', 'danger');
        }
        return $comments;
    }

    /**
     * @param Form $form
     * @param String $comment
     * @param Request $request
     * @param User $user
     * @return bool
     */
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
     * @param Form $form
     * @param String $comment
     * @param User $user
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
     * @param Event $eventId
     * @return array
     */
    public function getEventComments($eventId)
    {
        $results = $this->entityManager->getRepository("AtotrukisMainBundle:EventComments")->
            findBy(array('eventId' => $eventId), array('createdOn' => 'DESC'));
        $comments = array();
        foreach ($results as $result) {
            $comment = $result->getComment();
            $createdDate = $result->getCreatedOn();
            $user = $result->getUserId()->getName();
            $comments[] = array(
                'user' => $user,
                'date' => $createdDate,
                'comment' => $comment,
            );
        }
        return $comments;
    }

}
