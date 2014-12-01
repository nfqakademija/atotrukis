<?php

namespace Atotrukis\MainBundle\Controller;

use SimpleXMLElement;
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function manageEventsAction()
    {
        return $this->render('AtotrukisMainBundle:Admin:events.html.twig', array(
        ));
    }

    /**
     * updates events from bilietupasaulis.lt rss feed
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateEventsAction()
    {
        $content = file_get_contents("http://www.bilietupasaulis.lt/category.rss.php?path=lit/bilietai/visi");
        $x = new SimpleXmlElement($content);

        $regexDate = '/(\d{2}.\d{2}.\d{4})/i';
        $regexStartTime = '/(\d{2}:\d{2})/i';

        $this->get('adminService')->updateEvents($x, $regexDate, $regexStartTime);

//        return $this->redirect($this->generateUrl('admin_manage_events'));
    }

}
