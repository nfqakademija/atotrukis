<?php
namespace Atotrukis\MainBundle\Service;
use Doctrine\ORM\EntityManager;
use Atotrukis\MainBundle\Entity\EventKeywords;

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
    public function readUserEvents($userId, $request){

        $event = $this->em
            ->getRepository('AtotrukisMainBundle:Event')
            ->findByCreatedBy($userId);
        if (!$event) {
            $this->addFlash($request, 'Jūs neturite jokių renginių!', 'danger');
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
        $this->addFlash($request, 'Renginys sėkmingai ištrintas!', 'success');
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
        $em = $this->em;
        if ($form->isValid()) {
            if ($request->isMethod('POST')) {

                $this->setEventValues($form, $event, $user, $em);
                $this->removeOldKeywords($event, $em);
                $this->processNewKeywords($form, $event, $em);

                $em->flush();

                $this->addFlash($request, $message, 'success');
            }
        }

    }

    /**
     * @param $form
     * @param $event
     * @param $user
     * @param $em
     */
    public function setEventValues($form, $event, $user, $em)
    {
        $event->setName($form['name']->getData());
        $event->setDescription($form['description']->getData());
        $event->setStartDate($form['startDate']->getData());
        $event->setEndDate($form['endDate']->getData());
        $event->setMap($form['map']->getData());
        $event->setCity($this->getCity($form));
        $event->setCreatedBy($user);

        $em->persist($event);
    }

    /**
     * @param $form
     * @return mixed
     */
    public function getCity($form)
    {
        return $this->em->getRepository('AtotrukisMainBundle:City')
            ->findOneById($form['city']->getData());
    }

    /**
     * @param $event
     * @param $em
     */
    public function removeOldKeywords($event, $em)
    {
        $oldKeywords = $this->em->getRepository('AtotrukisMainBundle:EventKeywords')->findByEventId($event);

        foreach ($oldKeywords as $oldKeyword) {
            $em->remove($oldKeyword);
        }
    }

    /**
     * @param $form
     * @param $event
     * @param $em
     */
    public function processNewKeywords($form, $event, $em)
    {
        $keywords = $form['keywords']->getData();
        $keywords = preg_replace('!\s+!', ' ', $keywords);
        $keywords = explode(",", $keywords);

        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            $this->PersistKeywords($event, $em, $keyword);
        }
    }

    /**
     * @param $event
     * @param $em
     * @param $keyword
     */
    public function PersistKeywords($event, $em, $keyword)
    {
        $eventKeywords = new EventKeywords();
        $eventKeywords->setKeyword($keyword);
        $eventKeywords->setEventId($event);
        $em->persist($eventKeywords);
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

    public function getAttending($id) {
        $rep = $this->em->getRepository('AtotrukisMainBundle:Event');
        $qb = $rep->createQueryBuilder('e')
            ->select('count(e)')
            ->innerJoin('e.usersAttending', 'att', 'WITH', 'e.id = att.eventId')
            ->where('e.id = :id')
            ->setParameter('id', $id)
        ;
        return $qb->getQuery()->getSingleScalarResult();
    }

}