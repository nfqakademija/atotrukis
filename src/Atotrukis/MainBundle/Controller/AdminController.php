<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readUsersAction(Request $request)
    {
        $users = $this->get('adminService')->readUsers($request);

        return $this->render('AtotrukisMainBundle:Admin:users.html.twig', array('users' => $users));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function blockUserAction(Request $request, $id)
    {
        $this->get('adminService')->blockUser($request, $id);
        return $this->redirect($this->generateUrl('admin_users'));
    }
}
