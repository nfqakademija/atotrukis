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

    public function manageEventsAction()
    {
        return $this->render('AtotrukisMainBundle:Admin:events.html.twig', array(
        ));
    }

    public function updateEventsAction()
    {
        $content = file_get_contents("http://www.bilietupasaulis.lt/category.rss.php?path=lit/bilietai/visi");
        $x = new SimpleXmlElement($content);

        $regexDate = '/(\d{2}.\d{2}.\d{4})/i';
        $regexStartTime = '/(\d{2}:\d{2})/i';
        $regexEndDate = '/(- \d{2}.\d{2}.\d{4})/i';
        echo "<ul>";

        foreach($x->channel->item as $entry) {
            echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";

            // Getting end date in dd.mm.YYYY format
            if (preg_match($regexEndDate, $entry->title, $regEndMatch)) {
                preg_match($regexDate, $regEndMatch[1], $match);
//                echo "<li>". $match[1] ."</li>";
                $endNotYmd = $match[1];
            }

            // Getting title
            $splittedTitle = preg_split($regexDate, $entry->title);
            echo "<li>". $splittedTitle[0] ."</li>";
            $title = $splittedTitle[0];

            // Getting start date (datetime object)
            preg_match($regexDate, $entry->title, $regDateMatch);
            $explodedStartDate = explode('.', $regDateMatch[1]);
            $startYmd = $explodedStartDate[2] . "-" . $explodedStartDate[1] . "-" . $explodedStartDate[0];
            if (preg_match($regexStartTime, $entry->title, $regTimeMatch)) {
                $dateTime = $startYmd . " " . $regTimeMatch[1];
                echo $dateTime . "<br>";
            } else {
                $dateTime = $startYmd;
            }
            $startDate = new \DateTime($dateTime);

            // Getting end date (datetime object)
            if (isset($endNotYmd)) {

            } else {
                $endYmd = $startYmd;
            }

            // Getting description
            echo "<li>". $entry->description ."</li>";

        }
        echo "</ul>";
//        return $this->redirect($this->generateUrl('admin_manage_events'));
    }
}
