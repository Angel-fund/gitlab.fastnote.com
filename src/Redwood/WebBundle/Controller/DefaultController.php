<?php

namespace Redwood\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RedwoodWebBundle:Default:index.html.twig', array('name' => 'testtest'));
    }
}
