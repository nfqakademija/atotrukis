<?php

namespace Atotrukis\MainBundle\Service;

use Atotrukis\MainBundle\Entity\EventKeywords;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Atotrukis\MainBundle\Entity\Event;
use Symfony\Component\DomCrawler\Crawler;

class AdminService
{

    protected $entityManager;
    protected $container;

    /**
     * @param EventService $eventService
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(
        EntityManager $entityManager,
        ContainerInterface $container,
        EventService $eventService
    )
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
        $this->eventService = $eventService;
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
        $query = $this->entityManager->createQuery(
            'SELECT max(e.createdOn)
            FROM AtotrukisMainBundle:Event e
            WHERE e.createdBy IS NULL'
        );
        $latest = $query->getOneOrNullResult();
        foreach($x->channel->item as $entry) {

            if ($latest[1] < $entry->pubDate) {
                $name = preg_split($regexDate, $entry->title)[0];
                $startDate = $this->getStartDate($regexDate, $entry, $regexStartTime);
                $endDate = $this->getEndDate($regexDate, $entry, $regexStartTime);

                if (strip_tags($this->getDescription($entry))) {
                    $description = $this->getDescription($entry);

                    list($city, $coords) = $this->getCity($entry);

                    if ($city && $coords) {
                        $keywords = explode(" ", $name);

                        $this->addToDatabase($name, $startDate, $endDate, $description, $city, $coords, $keywords, $entry->pubDate);
                    }
                }
            }
        }
        $this->entityManager->flush();
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

    /**
     * gets end date
     *
     * @param $regexDate
     * @param $entry
     * @param $regexStartTime
     * @return \DateTime
     */
    private function getEndDate($regexDate, $entry, $regexStartTime)
    {
        preg_match($regexDate, $entry->title, $regStartOriginal);
        $exploded = explode($regStartOriginal[0], $entry->title);
        $endDate = $regStartOriginal[0];
        $dateWithDashes = $exploded[1];
        if (preg_match($regexDate, $dateWithDashes, $matchEndDate)) {
            $endDate = date('Y-m-d', strtotime($matchEndDate[0]));
        } else {
            $r = explode("Renginio trukmė:", $entry->description);
            if (isset($r[1])) {
                $r = explode("Pertraukos", $r[1]);
                if (isset($r[1])) {
                    $duration = str_replace('~', '', $r[0]);
                    if (preg_match('/\d{1}:\d{2}/', $duration, $mathDuration)) {
                        if (preg_match($regexStartTime, $entry->title, $regTimeMatch)) {
                            $start = strtotime($regTimeMatch[0]);
                            $dur = strtotime($mathDuration[0]);
                            $today = strtotime("TODAY");
                            $m_time1 = $start - $today;
                            $m_time2 = $dur - $today;
                            $endTime = $m_time1 + $m_time2 + $today;
                            $endTimeDate = date('H:i', $endTime);
                            $endDate = $regStartOriginal[0] . " " . $endTimeDate;
                        }
                    }
                }
            }
        }
        return new \DateTime($endDate);
    }

    /**
     * getting description from rss without red colored text which was in span tag
     *
     * @param $entry
     * @return mixed
     */
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
     * getting city from rss link with crawler
     *
     * @param $entry
     * @return string
     */
    private function getCity($entry)
    {
        $html = file_get_contents($entry->link);
        $crawler = new Crawler($html);
        if ($crawler->filterXPath('//div[@class="info_sidebar_venue_detail"]')) {
            if ($crawler->filterXPath('//div[@class="info_sidebar_venue_detail"]')->getNode(1)) {
                $city = $crawler->filterXPath('//div[@class="info_sidebar_venue_detail"]')->getNode(1)->textContent;
                $coords = $this->getCoordinates($crawler, $city);
                return array($city, $coords);
            }
        }
        return array("", "");
    }

    /**
     * getting google maps coordinates
     *
     * @param $crawler
     * @param $city
     * @return string
     */
    private function getCoordinates($crawler, $city)
    {
        $addr = $crawler->filterXPath('//div[@class="info_sidebar_venue_detail"]')->text() . ", " . $city;
        $address = urlencode($addr);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
        $response = file_get_contents($url);
        $json = json_decode($response,true);

        if ($json['results']) {
            $lat = $json['results'][0]['geometry']['location']['lat'];
            $lng = $json['results'][0]['geometry']['location']['lng'];

            return "(" . $lat . ", " . $lng . ")";
        } else {
            return "";
        }
    }

    /**
     * adds new events and their keywords to database
     *
     * @param $name
     * @param $startDate
     * @param $endDate
     * @param $description
     * @param $city
     * @param $coords
     * @param $keywords
     * @param $pubDate
     * @internal param $title
     */
    private function addToDatabase($name, $startDate, $endDate, $description, $city, $coords, $keywords, $pubDate)
    {
        $event = new Event();
        $event->setName($name);
        $event->setDescription($description);
        $event->setStartDate($startDate);
        $event->setEndDate($endDate);
        $event->setCity($city);
        $event->setMap($coords);
        $event->setCreatedOn(new \DateTime($pubDate));
        $this->entityManager->persist($event);
//        $this->entityManager->flush();

        $this->eventService->trimKeywords($event, $keywords);

        $this->entityManager->flush();
    }
}
