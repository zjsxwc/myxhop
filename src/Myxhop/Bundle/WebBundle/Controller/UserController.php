<?php

namespace Myxhop\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        /** @var \Symfony\Component\HttpFoundation\Session\Session $session */
        $session = $request->getSession();
        $errorKey = SecurityContext::AUTHENTICATION_ERROR;
        $authError = $session->get($errorKey);
        if ($authError) {
            $session->remove($errorKey);
        }
        /**
         * @TODO Use CSRF
         * we can refer to FOSUserBundle-master/Controller/SecurityController.php:52
         */

        return $this->render('MyxhopWebBundle:User:login.html.twig', array(
                'error' => $authError
            ));
    }

}
