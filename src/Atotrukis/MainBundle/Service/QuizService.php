<?php

namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class QuizService
{

    protected $entityManager;
    protected $securityContext;
    protected $userKeywordService;

    public function __construct(EntityManager $entityManager, SecurityContext $securityContext, UserKeywordService $userKeywordService)
    {
        $this->entityManager = $entityManager;
        $this->securityContext = $securityContext;
        $this->userKeywordService = $userKeywordService;
    }

    public function addKeywords($form, $request)
    {
        $form->handleRequest($request);
        $usr = $this->entityManager->getRepository('AtotrukisMainBundle:User')
            ->findOneById($this->securityContext->getToken()->getUser());
        foreach ($form->getData() as $data) {
            if (is_array($data)) {
                foreach ($data as $k) {
                    $this->userKeywordService->addKeyword($k, $usr);
                }
            } else {
                $keywords = preg_split("/[, ]/", $data);
                foreach ($keywords as $keys) {
                    $this->userKeywordService->addKeyword($keys, $usr);
                }
            }
        }
    }
}