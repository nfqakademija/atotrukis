<?php
namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserService
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

    public function getUserById($userId)
    {
        $user = $this->entityManager->getRepository("AtotrukisMainBundle:User")->
            findOneBy(array('id' => $userId));
        return $user;
    }
}

