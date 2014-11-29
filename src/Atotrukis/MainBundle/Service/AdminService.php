<?php

namespace Atotrukis\MainBundle\Service;

use Atotrukis\MainBundle\Entity\EventKeywords;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Atotrukis\MainBundle\Entity\Event;

class AdminService
{

    protected $entityManager;
    protected $container;

    /**
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $entityManager, ContainerInterface $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    /**
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @return array of \Atotrukis\MainBundle\Entity\User
     */
    public function readUsers($request)
    {

        $user = $this->entityManager
            ->getRepository('AtotrukisMainBundle:User')
            ->findAll();
        if (!$user) {
            $this->addFlash($request, 'Vartotojų nėra!', 'danger');
        }
        return $user;
    }

    /**
     * blocks/unblocks user
     *
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @param $userId int
     */
    public function blockUser($request, $userId)
    {

        $user = $this->entityManager
            ->getRepository('AtotrukisMainBundle:User')
            ->findOneById($userId);
        if (!$user) {
            $this->addFlash($request, 'Vartotojo su tokiu ID nėra!', 'danger');
        }
        if ($user->isLocked()) {
            $user->setLocked(0);
        } else {
            $user->setLocked(1);
        }
        $entityManager = $this->entityManager;
        $entityManager->persist($user);
        $entityManager->flush();
    }

    /**
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @param $message String
     * @param $status String
     */
    public function addFlash($request, $message, $status)
    {
        $request->getSession()->getFlashBag()->add($status, $message);
    }

    /**
     * gets information from rss feed
     *
     * @param $x
     * @param $regexDate
     * @param $regexStartTime
     */
    public function updateEvents($x, $regexDate, $regexStartTime)
    {
        foreach($x->channel->item as $entry) {

            $name = preg_split($regexDate, $entry->title)[0];

            $startDate = $this->getStartDate($regexDate, $entry, $regexStartTime);
            $endDate = $startDate;

            $description = $this->getDescription($entry);
            $this->getDescription($entry);

            $keywords = explode(" ", $entry->title);

            if ($name) {
                $this->addToDatabase($name, $startDate, $endDate, $description, $keywords);
            }
        }
    }

    /**
     * changes date format from dd.mm.yyyy to yyyy.mm.dd
     *
     * @param $regexDate
     * @param $entry
     * @return string of date in yyyy.mm.dd format
     */
    private function getStartDateYmd($regexDate, $entry)
    {
        preg_match($regexDate, $entry->title, $regDateMatch);
        $startYmd = date('Y-m-d', strtotime($regDateMatch[1]));
        return $startYmd;
    }

    /**
     * joins date, hour and minutes to one datetime object
     *
     * @param $regexDate
     * @param $entry
     * @param $regexStartTime
     * @return \DateTime of start date
     */
    private function getStartDate($regexDate, $entry, $regexStartTime)
    {
        $startYmd = $this->getStartDateYmd($regexDate, $entry);
        if (preg_match($regexStartTime, $entry->title, $regTimeMatch)) {
            $dateTime = $startYmd . " " . $regTimeMatch[1];
        } else {
            $dateTime = $startYmd;
        }
        return new \DateTime($dateTime);
    }

    private function getDescription($entry)
    {
        $exploded = explode("Durys atidaromos", $entry->description);
        if (preg_match('#<span style=\"(.*)\">(.*?)</span>#', $exploded[0], $match)) {
            $withoutColored = preg_replace('#<span style=\"(.*)\">(.*?)</span>#', '', $exploded[0]);
            return $withoutColored;
        } else {
            return $exploded[0];
        }
    }

    /**
     * adds new events and their keywords to database
     *
     * @param $name
     * @param $startDate
     * @param $endDate
     * @param $description
     * @param $keywords
     * @internal param $title
     */
    private function addToDatabase($name, $startDate, $endDate, $description, $keywords)
    {
        $event = new Event();
        $event->setName($name);
        $event->setDescription($description);
        $event->setStartDate($startDate);
        $event->setEndDate($endDate);
        $event->setCity("Kaunas");
        $event->setMap("(54.8985207, 23.90359650000005)");
        $user = $this->entityManager->getRepository('AtotrukisMainBundle:User')
            ->findOneById($this->container->get('security.context')->getToken()->getUser()->getId());
        $event->setCreatedBy($user);
        $this->entityManager->persist($event);
        $this->entityManager->flush();
        foreach ($keywords as $kwd) {
            $keyword = new EventKeywords();
            $keyword->setEventId($event);
            $keyword->setKeyword($kwd);
            $this->entityManager->persist($keyword);
            $this->entityManager->flush();
        }
    }
}
