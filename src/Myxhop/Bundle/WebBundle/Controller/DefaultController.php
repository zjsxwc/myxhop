<?php

namespace Myxhop\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyxhopWebBundle:Default:index.html.twig');
    }
}
