<?php

namespace Atotrukis\MainBundle\Service;

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

            // Getting title
            $splittedTitle = preg_split($regexDate, $entry->title);
            $title = $splittedTitle[0];

            $startDate = $this->getStartDate($regexDate, $entry, $regexStartTime);
            $endDate = $startDate;

            // Getting description
            $description = strip_tags($entry->description);

            if ($title && $startDate && $endDate && $description) {
                $this->addToDatabase($title, $startDate, $endDate, $description);
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
        $explodedStartDate = explode('.', $regDateMatch[1]);
        $startYmd = $explodedStartDate[2] . "-" . $explodedStartDate[1] . "-" . $explodedStartDate[0];
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

    /**
     * adds new events to database
     *
     * @param $title
     * @param $startDate
     * @param $endDate
     * @param $description
     */
    private function addToDatabase($title, $startDate, $endDate, $description)
    {
        $event = new Event();
        $event->setName($title);
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
    }
}
