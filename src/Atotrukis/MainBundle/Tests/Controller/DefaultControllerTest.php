<?php

namespace Atotrukis\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Atotrūkis")')->count() > 0);
    }

    public function testGetCity()
    {
        $userIp = $this->getKernel()->get('cityService')->getUserIP();
        $lookup = $this->getKernel()->get('maxmind.geoip')->lookup($userIp);
        $this->assertEquals($lookup->getCity(), 'Kaunas');
    }

    public function testSelectedEventsNotGranted()
    {
        $userIp = $this->getKernel()->get('cityService')->getUserIP();
        $geoip = $this->getKernel()->get('maxmind.geoip')->lookup($userIp);
        $this->getKernel()->get('homePageService')->setGeoIp($geoip);
        $events = $this->getKernel()->get('homePageService')->getEvents(false);
        $eventCount = count($events);
        $eventCountInDB = count($this->getKernel()->get('eventService')->getAllEvents());
        $this->assertTrue($eventCount > 0 && $eventCountInDB > 0);
    }

    public function testSelectedEventsAuthenticated()
    {
        $userIp = $this->getKernel()->get('cityService')->getUserIP();
        $geoip = $this->getKernel()->get('maxmind.geoip')->lookup($userIp);
        $this->getKernel()->get('homePageService')->setGeoIp($geoip);
        $events = $this->getKernel()->get('homePageService')->getEvents(true, 'Kaunas');
        $allFromKaunas = true;
        foreach ($events as $event) {
            if (trim($event->getCity()) != 'Kaunas') {
                $allFromKaunas = false;
            }
        }
        $this->assertTrue($allFromKaunas);
    }

    public function testFirstIsBest()
    {
        $userId =  $this->getKernel()->get('userService')->getUserById(3);
        $userIp = $this->getKernel()->get('cityService')->getUserIP();
        $geoip = $this->getKernel()->get('maxmind.geoip')->lookup($userIp);
        $this->getKernel()->get('homePageService')->setGeoIp($geoip);
        $events = $this->getKernel()->get('homePageService')->getEvents(true, 'Kaunas');
        $bestValue = 0;
        $bestId = 0;
        foreach ($events as $event) {
            $eventKeywords = $this->getKernel()->get('searchService')->getEventKeywordsByEvent($event->getId());
            //transform keyword array to appropriate keyword => value
            $keywordArray = array();
            foreach ($eventKeywords as $key) {
                $keywordArray[$key->getKeyword()] = 1;
            }
            $eventRate = $this->getKernel()->get('userKeywordService')->getEventRate($keywordArray, $userId);
            if ($eventRate > $bestValue) {
                $bestValue = $eventRate;
                $bestId = $event->getId();
            }
        }
        $this->assertEquals($bestId, 18);
    }

    private function getKernel()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        return $kernel->getContainer();
    }
}
