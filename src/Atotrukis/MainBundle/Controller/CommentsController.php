<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Atotrukis\MainBundle\Form\Type\CreateCommentFormType;
use Symfony\Component\HttpFoundation\Request;
use Atotrukis\MainBundle\Entity\EventComments;
use Atotrukis\MainBundle\Entity\Event;

class CommentsController extends Controller
{
    //TODO: create default event with 0 id
    public function createCommentAction(Request $request, $eventId=0)
    {
        $comment = new EventComments();
        $form = $this->createForm('createCommentForm', $comment);

        if ($this->get('commentsService')->createComment($comment, $form, $request, $this->getUser())) {
            return $this->redirect($this->generateUrl('_show_event', array('eventId' => $form['eventId']->getData() )));
        }
        return $this->render('AtotrukisMainBundle:Comment:addComment.html.twig', array(
            'form' => $form->createView(),
            'eventId' => $eventId,
        ));
    }

    public function showComments()
    {

    }

    /**
     * @return bool|\Atotrukis\MainBundle\Entity\User
     */
    public function getUser()
    {
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
                ->findOneById($this->get('security.context')->getToken()->getUser()->getId());
            return $user;
        }
        return false;
    }
}
