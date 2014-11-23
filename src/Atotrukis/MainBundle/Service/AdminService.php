<?php

namespace Atotrukis\MainBundle\Service;

use Doctrine\ORM\EntityManager;

class AdminService
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function readUsers($request)
    {

        $user = $this->entityManager
            ->getRepository('AtotrukisMainBundle:User')
            ->findAll();
        if (!$user) {
            $this->addFlash($request, 'Vartotojų nėra!', 'danger');
        }
        return $user;
    }
    public function blockUser($request, $userId)
    {

        $user = $this->entityManager
            ->getRepository('AtotrukisMainBundle:User')
            ->findOneById($userId);
        if (!$user) {
            $this->addFlash($request, 'Vartotojo su tokiu ID nėra!', 'danger');
        }
        if ($user->isLocked()) {
            $user->setLocked(0);
        } else {
            $user->setLocked(1);
        }
        $entityManager = $this->entityManager;
        $entityManager->persist($user);
        $entityManager->flush();
    }

    /**
     * @param $request
     * @param $message
     * @param $status
     */
    public function addFlash($request, $message, $status)
    {
        $request->getSession()->getFlashBag()->add($status, $message);
    }
}
