<?php
namespace Atotrukis\MainBundle\Service;
use Doctrine\ORM\EntityManager;

class AdminService{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function readUsers($request){

        $user = $this->em
            ->getRepository('AtotrukisMainBundle:User')
            ->findAll();
        if (!$user) {
            $this->addFlash($request, 'Vartotojų nėra!', 'danger');
        }
        return $user;
    }
    public function blockUser($request, $id){

        $user = $this->em
            ->getRepository('AtotrukisMainBundle:User')
            ->findOneById($id);
        if (!$user) {
            $this->addFlash($request, 'Vartotojo su tokiu ID nėra!', 'danger');
        }
        if($user->isLocked()){
            $user->setLocked(0);
        }else{
            $user->setLocked(1);
        }
        $em = $this->em;
        $em->persist($user);
        $em->flush();
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