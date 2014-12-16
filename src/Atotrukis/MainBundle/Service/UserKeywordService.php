<?php
namespace Atotrukis\MainBundle\Service;

use Atotrukis\MainBundle\Entity\UserInterest;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserKeywordService
{
    /**
     * @var EntityManager
     */
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
     * Add keyword to user base
     *
     * @param String $keyword   keyword name
     * @param User $userID    id of user
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
     * @param String $keyword   keyword name
     * @param User $userID    id of user
     */
    private function keywordUpdate($keyword)
    {
        $keyword->setUpdateDate();
        $keywordValue = $keyword->getValue();
        $newKeywordValue = $keywordValue + 1;
        $keyword->setValue($newKeywordValue);
        $this->entityManager->persist($keyword);
        $this->entityManager->flush();
    }

    /**
     * Create keyword
     *
     * @param String $keyword   keyword name
     * @param $userID    /Atotrukis/MainBundle/Entity/User of user
     */
    private function keywordCreate($keyword, $userID)
    {
        $key = new UserInterest();
        $key->setUpdateDate();
        $key->setKeyword($keyword);
        $key->setValue(1);
        $key->setUserId($userID);
        $this->entityManager->merge($key);
        $this->entityManager->flush();
    }

    /* Delete keyword
    *
    * @param String $keyword   keyword name
    * @param User $userID    /Atotrukis/MainBundle/Entity/User of user
    */
    public function keywordDelete($keyword, $userID)
    {
        $key = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
        findOneBy(array('keyword' => $keyword, 'userId' => $userID));
        $this->entityManager->remove($key);
        $this->entityManager->flustah();
    }

    /**
     * Rate event by keywords
     *
     * @param String $eventKeywords   event keywor array key=>keywordName, value=>keywordValue
     * @param User $userID    id of user
     * @return Int rate value
     */
    public function getEventRate($eventKeywords, $userId)
    {
        $rate = 0;
        foreach ($eventKeywords as $eventKey => $eventValue) {
            $userKey = $this->getKeyword($userId, $eventKey);
            if ($userKey) {
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
     * @param String $keyword   keyword name
     * @param User $userID    id of user
     * @return difference in days if updateDate is older than 60 days, or false
     */
    private function checkIfKeywordExpired($keyword, $userID)
    {
        $key = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
        findOneBy(array('keyword' => $keyword, 'userId' => $userID));
        if ($key == null) {
            return false;
        }
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
     * @param User $userID    id of user
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
     * @param User $userID    id of user
     * @param String $keyword    keyword to find
     * @return String keyword or false
     */
    public function getKeyword($userID, $keyword)
    {
        $key = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
        findOneBy(array('keyword' => $keyword, 'userId' => $userID));
        return $key;
    }

    /**
     * gets user all keywords value
     *
     * @param User $userID    id of user
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

    /**
     * adds keywords to database from quiz
     *
     * @param Form $form
     * @param $request
     */
    public function addKeywordsFromQuiz($form, $request)
    {
        $form->handleRequest($request);
        $usr = $this->entityManager->getRepository('AtotrukisMainBundle:User')
            ->findOneById($this->container->get('security.context')->getToken()->getUser());
        foreach ($form->getData() as $data) {
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $this->addKeyword($value, $usr);
                    if ($value == "rokas" || $value == "elektroninė" || $value == "pop" || $value == "repas") {
                        $this->addMusicKeywords($usr, $value);
                    }
                    if ($value == "krepšinis" || $value == "futbolas" || $value == "tinklinis" || $value == "ritulys") {
                        $this->addSportKeywords($usr, $value);
                    }
                }
            } else {
                $keywords = preg_split("/[, ]/", $data);
                $previousValue = null;
                foreach ($keywords as $key => $value) {
                    if ($value) {
                        $this->addKeyword($value, $usr);
                        if (!$previousValue && $key == 0) {
                            $this->addAbstractMusicKeywords($usr);
                        }
                        if ($previousValue && $key == 0) {
                            $this->addAbstractSportKeywords($usr);
                        }
                        $previousValue = $value;
                    }
                }
            }
        }
    }

    /**
     * adds keywords related with music if user chosen at least one music genre in quiz
     *
     * @param $usr
     */
    private function addAbstractMusicKeywords($usr)
    {
        $keyw = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
            findOneBy(array('keyword' => 'muzika', 'userId' => $usr));
        if (!$keyw) {
            $this->addKeyword("muzika", $usr);
            $this->addKeyword("muzikos", $usr);
            $this->addKeyword("koncertas", $usr);
        }
    }

     /**
     * adds keywords related with sport if user chosen at least one favorite sport in quiz
     *
     * @param $usr
     */
    private function addAbstractSportKeywords($usr)
    {
        $keyw = $this->entityManager->getRepository("AtotrukisMainBundle:UserInterest")->
            findOneBy(array('keyword' => 'varžybos', 'userId' => $usr));
        if (!$keyw) {
            $this->addKeyword("varžybos", $usr);
            $this->addKeyword("rungtynės", $usr);
            $this->addKeyword("sportas", $usr);
            $this->addKeyword("sporto", $usr);
        }
    }

     /**
     * adds similar music keywords by quiz values
     *
     * @param $usr
     * @param $value
     */
    private function addMusicKeywords($usr, $value)
    {
        $this->addAbstractMusicKeywords($usr);
        if ($value == "rokas") {
            $this->addKeyword("rock", $usr);
            $this->addKeyword("roko", $usr);
        }
        if ($value == "elektroninė") {
            $this->addKeyword("electro", $usr);
        }
        if ($value == "pop") {
            $this->addKeyword("popsas", $usr);
            $this->addKeyword("populiarioji", $usr);
        }
        if ($value == "repas") {
            $this->addKeyword("repo", $usr);
        }
    }

     /**
     * adds similar sport keywords by quiz values
     *
     * @param User $usr
     * @param Int $value
     */
    private function addSportKeywords($usr, $value)
    {
        $this->addAbstractSportKeywords($usr);
        if ($value == "krepšinis") {
            $this->addKeyword("krepšinio", $usr);
        }
        if ($value == "futbolas") {
            $this->addKeyword("futbolo", $usr);
        }
        if ($value == "tinklinis") {
            $this->addKeyword("tinklinio", $usr);
        }
        if ($value == "ritulys") {
            $this->addKeyword("ledo", $usr);
            $this->addKeyword("ritulio", $usr);
        }
    }
}

