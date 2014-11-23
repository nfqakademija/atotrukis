<?php

namespace Atotrukis\MainBundle\Service;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class SearchService
{
    private $templating;
    private $eventService;
    private $userKeywordService;

    public function __construct(
        EngineInterface $templating,
        EventService $eventService,
        UserKeywordService $userKeywordService
    ) {
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

//                return $this->templating->renderResponse(
//                    'AtotrukisMainBundle:Event:searchEvents.html.twig',
//                    array(
//                        'search' => $form->createView()
//                    )
//                );
                return true;
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

    public function getResults()
    {

    }
}
