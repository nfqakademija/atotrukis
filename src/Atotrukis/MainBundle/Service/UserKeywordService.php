<?php
namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;
use Atotrukis\MainBundle\Entity\UserAttending;

class UserKeywordService
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Add keyword to user base
     *
     * @param $keyword   keyword name
     * @param $userID    id of user
     */
    public function addKeyword($keyword, $userID)
    {
        $key = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
        findOneBy(array('keyword' => $keyword, 'userId' => $userID));
        if (!$key) {
            $this->keywordCreate($keyword, $userID);
        } else {
            $this->keywordUpdate($key);
        }
    }

    /**
     * Update keyword
     *
     * @param $keyword   keyword name
     * @param $userID    id of user
     */
    private function keywordUpdate($keyword)
    {
        $keyword->setUpdateDate();
        $keywordValue = $keyword->getValue();
        $newKeywordValue = $keywordValue + 1;
        $keyword->setValue($newKeywordValue);
    }

    /**
     * Create keyword
     *
     * @param $keyword   keyword name
     * @param $userID    id of user
     */
    private function keywordCreate($keyword, $userID)
    {
        $key = new UserAttending();
        $key->setUpdateDate();
        $key->setKeyword($keyword);
        $key->setValue(1);
        $key->setUserId($userID);
        $this->entityManager->persist($key);
    }

    /**
     * Rate event by keywords
     *
     * @param $eventKeywords   event keywor array key=>keywordName, value=>keywordValue
     * @param $userID    id of user
     * @return Int rate value
     */
    public function getEventRate($eventKeywords, $userId)
    {
        $rate = 0;
        foreach ($eventKeywords as $eventKey => $eventValue) {
            $userKey = $this->getKeyword($userId, $eventKey);
            if (!$userKey) {

            } else {
                $userAllKeyValues = $this->getAllKeywordsValueCount($userId);
                $userKeyValue = $userKey->getValue() / $userAllKeyValues;
                if (!$this->checkIfKeywordExpired($userKey, $userId)) {
                    $rate += $userKeyValue;
                } else {
                    $rate = $rate + $userKeyValue / ($this->checkIfKeywordExpired($userKey, $userId) / 60);
                }

            }
        }
        return $rate;
    }

    /**
     * Check if user keyword last upate date is older than 60 days
     * if true, the value of keyword should become
     * value * differenceInDays/60
     *
     * @param $keyword   keyword name
     * @param $userID    id of user
     * @return difference in days if updateDate is older than 60 days, or false
     */
    private function checkIfKeywordExpired($keyword, $userID)
    {
        $key = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
        findOneBy(array('keyword' => $keyword, 'userId' => $userID));
        $lastUpdateDate = $key->getUpdateDate();
        $diffInSeconds = strtotime(date('Y-m-d')) - strtotime($lastUpdateDate);
        $diffInDays = $diffInSeconds / (60 * 60 * 24);
        if ($diffInDays > 60) {
            return $diffInDays;
        }
        return false;
    }

    /**
     * get user keywords
     *
     * @param $userID    id of user
     * @return Array of keywords user has
     */
    private function getKeywords($userID)
    {
        $keys = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->findByUserId($userID);
        return $keys;
    }

    /**
     * get user keyword
     *
     * @param $userID    id of user
     * @param $keyword    keyword to find
     * @return String keyword or false
     */
    private function getKeyword($userID, $keyword)
    {
        $key = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
        findOneBy(array('keyword' => $keyword, 'userId' => $userID));
        return $key;
    }

    /**
     * gets user all keywords value
     *
     * @param $userID    id of user
     * @return Int count
     */
    private function getAllKeywordsValueCount($userId)
    {
        $keys = $this->getKeywords($userId);
        $count = 0;
        foreach ($keys as $key) {
            $count = $key->getValue();
        }
        return $count;
    }
}