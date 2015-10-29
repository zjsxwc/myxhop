<?php

namespace Myxhop\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MyxhopWebBundle:Default:index.html.twig', array('name' => $name));
    }
}
