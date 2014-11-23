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

    public function handleFormRequest($form, $request, $user)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($request->isMethod('POST')) {
                $this->processKeywords($form, $user);
                $searchResult = $this->getResults($form['keywords']->getData());
                return array('formIsValid' => true, 'searchResult' => $searchResult);
            }
        }

    }

    /**
     * @param $form
     * @param $user
     */
    public function processKeywords($form, $user)
    {
        $keywords = $this->eventService->explodeKeywords($form);

        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            $this->userKeywordService->addKeyword($keyword, $user);
        }
    }

    public function getResults($searchKeywords)
    {
        $events = $this->entityManager->getRepository('AtotrukisMainBundle:Event')->findAll();
        $searchKeywords = array_unique($searchKeywords);
        $searchResult = array();
        foreach ($events as $event) {
            $eventKeywords = $this->entityManager
                ->getRepository('AtotrukisMainBundle:EventKeywords')
                ->findByEventId($event);
            $eventKeywordCount = sizeof($eventKeywords);
            $matchedKeywordsCount = 0;
            foreach ($eventKeywords as $eventKeyword) {
                foreach ($searchKeywords as $searchKeyword) {
                    if ($eventKeyword == $searchKeyword) {
                        $matchedKeywordsCount++;
                    }
                }
            }
            $matched = $matchedKeywordsCount / $eventKeywordCount * 100;
            array_push($searchResult, array("event" => $event, "matched" => $matched));
        }

        return $this->sortArray($searchResult);
    }

    /**
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
}
