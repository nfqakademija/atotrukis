<?php

namespace Atotrukis\MainBundle\Service;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Doctrine\ORM\EntityManager;

class SearchService
{
    private $templating;
    private $eventService;
    private $userKeywordService;
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     * @param EngineInterface $templating
     * @param EventService $eventService
     * @param UserKeywordService $userKeywordService
     */
    public function __construct(
        EntityManager $entityManager,
        EngineInterface $templating,
        EventService $eventService,
        UserKeywordService $userKeywordService
    ) {
        $this->entityManager = $entityManager;
        $this->templating = $templating;
        $this->eventService = $eventService;
        $this->userKeywordService = $userKeywordService;
    }

    /**
     * @param $form \Atotrukis\MainBundle\Form\Type\SearchFormType
     * @param $request
     * @param $user \Atotrukis\MainBundle\Entity\User
     * @return array formIsValid - bool, searchResult - array of events and matched percents
     */
    public function handleFormRequest($form, $request, $user)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($request->isMethod('POST')) {
                if ($user) {
                    $this->processKeywords($form, $user);
                }
                $searchResult = $this->getResults($this->eventService->explodeKeywords($form['keywords']->getData()), $request);
                return array('formIsValid' => true, 'searchResult' => $searchResult);
            }
        }

    }

    /**
     * explodes keywords by spaces and trims any other spaces from the string of keywords
     * @param $form
     * @param $user
     */
    public function processKeywords($form, $user)
    {
        $keywords = $this->eventService->explodeKeywords($form['keywords']->getData());

        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            $this->userKeywordService->addKeyword($keyword, $user);
        }
    }

    /**
     * calculates the how many percent of the entered keywords matches to Event keywords and adds events with the
     * matching percent to the array and sorts it by matching percent DESC
     *
     * @param $searchKeywords
     * @param $request
     * @return mixed
     */
    public function getResults($searchKeywords, $request)
    {
        $events = $this->entityManager->getRepository('AtotrukisMainBundle:Event')->findAll();
        $searchKeywords = array_unique($searchKeywords);
        $searchResult = array();
        foreach ($events as $event) {
            $eventKeywords = $this->getEventKeywordsByEvent($event);
            $eventKeywordCount = sizeof($eventKeywords);
            $matchedKeywordsCount = 0;
            foreach ($eventKeywords as $eventKeyword) {
                $keyword = $eventKeyword->getKeyword();
                foreach ($searchKeywords as $searchKeyword) {
                    $searchKeyword = trim($searchKeyword);
                    if ($keyword == $searchKeyword) {
                        $matchedKeywordsCount++;
                    }
                }
            }
            if ($eventKeywordCount != 0) {
                $matched = $matchedKeywordsCount / $eventKeywordCount * 100;
            } else {
                $matched = 0;
            }
            if ($matched > 0) {
                array_push($searchResult, array("event" => $event, "matched" => $matched));
            }
        }
        if (empty($searchResult)) {
            $this->eventService->addFlash($request, 'Pagal jūsų paieškos žodžius renginių nerasta', 'warning');
        }
        return $this->sortArray($searchResult);
    }

    /**
     * sorts the $searchResult array by matching percent DESC
     *
     * @param $searchResult
     * @return mixed
     */
    private function sortArray($searchResult)
    {
        $matchedPercent = array();
        foreach ($searchResult as $key => $row) {
            $matchedPercent[$key] = $row['matched'];
        }
        array_multisort($matchedPercent, SORT_DESC, $searchResult);
        return $searchResult;
    }

    /**
     * @param $event
     * @return mixed
     */
    public function getEventKeywordsByEvent($event)
    {
        $eventKeywords = $this->entityManager
            ->getRepository('AtotrukisMainBundle:EventKeywords')
            ->findByEventId($event);
        return $eventKeywords;
    }
}
