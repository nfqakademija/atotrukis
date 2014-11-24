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
     * creates comment in event
     * @param $comment
     * @param $form
     * @param $request
     * @param $user
     * @return mixed
     */
    public function createComment($comment, $form, $request, $user)
    {
        return $this->handleFormRequest($form, $comment, $request, $user, 'Komentaras sėkmingai sukurtas!');
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

    public function handleFormRequest($form, $comment, $request, $user, $message)
    {
        $form->handleRequest($request);
        $entityManager = $this->entityManager;
        if ($form->isValid()) {
            if ($request->isMethod('POST')) {
                $this->setEventValues($form, $comment, $user, $entityManager);

                $entityManager->flush();

                return true;
            }
            return false;
        }
        return false;
    }

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
}
