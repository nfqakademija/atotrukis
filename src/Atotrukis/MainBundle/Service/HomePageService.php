<?php

namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;

class HomePageService
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEvents($user)
    {
        if ($user) {
            $queryBuilder = $this->entityManager->createQueryBuilder()
                ->select('event')
                ->from('AtotrukisMainBundle:Event', 'event')
                ->innerJoin('AtotrukisMainBundle:EventKeywords', 'eKeyword', 'with', 'eKeyword.eventId = event.id')
                ->innerJoin(
                    'AtotrukisMainBundle:UserInterest',
                    'uInterest',
                    'with',
                    'uInterest.keyword = eKeyword.keyword'
                )
                ->where('event.endDate >= :today')
                ->andWhere('uInterest.userId = :user')
                ->setParameter('today', new \DateTime())
                ->setParameter('user', $user);
        } else {
            $queryBuilder = $this->entityManager->createQueryBuilder()
                ->select('event')
                ->from('AtotrukisMainBundle:Event', 'event')
                ->where('event.startDate >= :today')
                ->setParameter('today', new \DateTime());
        }
        return $queryBuilder->getQuery()->getResult();
    }

    private function getEventKeywords($event)
    {
        $keywords = $this->entityManager->createQueryBuilder()
            ->select('keywords')
            ->from('AtotrukisMainBundle:EventKeywords', 'keywords')
            ->where('keywords.eventId = :event')
            ->setParameter('event', $event);
        return $keywords->getQuery()->getResult();
    }

    private function getInterests($keyword, $user)
    {
        $interests = $this->entityManager->createQueryBuilder()
            ->select('interests')
            ->from('AtotrukisMainBundle:UserInterest', 'interests')
            ->where('interests.keyword = :keyword')
            ->andWhere('interests.userId = :user')
            ->setParameter('keyword', $keyword)
            ->setParameter('user', $user);
        return $interests->getQuery()->getOneOrNullResult();
    }

    public function getBestEvents($user)
    {
        $array = array();
        $events = $this->getEvents($user);
        foreach ($events as $event) {
            $keywords = $this->getEventKeywords($event);
            $intValue = 0;
            foreach ($keywords as $keys) {
                $interests = $this->getInterests($keys->getKeyword(), $user);
                if ($interests) {
                    $intValue += $interests->getValue();
                }
            }
            array_push($array, array('event' => $event, 'interestValue' => $intValue));
        }
        return $this->sortEvents($array);
    }

    public function sortEvents($array)
    {
        $newArray = array();
        $sorted = array();
        foreach ($array as $key => $row) {
            $newArray[$key] = $row['interestValue'];

        }
        array_multisort($newArray, SORT_DESC, $array);
        foreach ($array as $key => $arr) {
            $sorted[$key] = $arr['event'];
        }
        return $sorted;
    }

    public function paginate($paginator, $request, $max, $user)
    {
        if ($user) {
            $pagination = $paginator->paginate(
                $this->getBestEvents($user),
                $request, /*page number*/
                $max/*limit per page*/
            );
        } else {
            $pagination = $paginator->paginate(
                $this->getEvents($user),
                $request, /*page number*/
                $max/*limit per page*/
            );
        }
        return $pagination;
    }

}