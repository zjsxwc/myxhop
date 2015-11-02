<?php

namespace Myxhop\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Security;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $lastUsernameKey = Security::LAST_USERNAME;
        $authErrorKey = Security::AUTHENTICATION_ERROR;

        /** @var \Symfony\Component\HttpFoundation\Session\Session $session */
        $session = $request->getSession();

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        /**
         * @TODO Use CSRF
         * we can refer to FOSUserBundle-master/Controller/SecurityController.php:52
         */

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        return $this->render('MyxhopWebBundle:User:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

}
