<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AtotrukisMainBundle:Default:index.html.twig', array('name' => $name));
    }
}
