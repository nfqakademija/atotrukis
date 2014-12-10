<?php

namespace Atotrukis\MainBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Atotrukis\MainBundle\Entity\User;

class UserKeywordServiceTest extends WebTestCase
{
    private $newKeyword = 'test123456789test';

    public function testNewKeyword()
    {
        $this->addKeyword($this->newKeyword);
        $keyCreated = $this->checkIfExist($this->newKeyword, 3);
        $this->assertTrue($keyCreated);
    }

    public function testNewExistingKeyword()
    {
        $this->addKeyword($this->newKeyword);
        $keyCreated = $this->getKernel()->get('userKeywordService')->getKeyword(
            $this->getKernel()->get('userService')->getUserById(3),
            $this->newKeyword
        );
        $this->assertEquals($keyCreated->getValue(), 2);
    }

    public function testDeleteKeyword()
    {
        $this->deleteKeyword($this->newKeyword);
        $keyCreated = $this->checkIfExist($this->newKeyword, 3);
        $this->assertFalse($keyCreated);
    }

    public function testGetEventRate()
    {
        $eventKeywords = array(
            'test' => 1,
            'test2' => 1,
            'testNULL' => 1,
        );
        $userId =  $this->getKernel()->get('userService')->getUserById(3);
        $this->addKeyword('test');
        $this->addKeyword('test2');
        $eventRate = $this->getKernel()->get('userKeywordService')->getEventRate($eventKeywords, $userId);
        $this->deleteKeyword('test');
        $this->deleteKeyword('test2');
        $this->assertEquals($eventRate, 2);
    }

    private function deleteKeyword($keyword)
    {
        $this->getKernel()->get('userKeywordService')->keywordDelete(
            $keyword,
            $this->getKernel()->get('userService')->getUserById(3)
        );
    }

    private function addKeyword($keyword)
    {
        $this->getKernel()->get('userKeywordService')->addKeyword(
            $keyword,
            $this->getKernel()->get('userService')->getUserById(3)
        );
    }

    private function checkIfExist($keyword, $userId)
    {
        $kernel = $this->getKernel();
        $userKeywordService = $kernel->get('UserKeywordService');
        $key = $userKeywordService->getKeyword($userId, $keyword);
        if ($key == null) {
            return false;
        } else {
            return true;
        }
    }

    private function getKernel()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        return $kernel->getContainer();
    }

}
