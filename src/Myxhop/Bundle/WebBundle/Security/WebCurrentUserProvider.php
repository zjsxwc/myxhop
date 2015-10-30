<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 10/30/15
 * Time: 11:55 AM
 */

namespace Myxhop\Bundle\WebBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class WebCurrentUserProvider implements UserProviderInterface
{
    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function getDoctrine()
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return $this->container->get('doctrine');
    }

    public function loadUserByUsername($username)
    {
        /** @var \Myxhop\Bundle\WebBundle\Entity\UserRepository $userRepository */
        $userRepository = $this->getDoctrine()
            ->getRepository('MyxhopWebBundle:User');

        /** @var \Myxhop\Bundle\WebBundle\Entity\User $userData */
        $userData = $userRepository->findOneBy(['name' => $username]);
        // pretend it returns an array on success, false if there is no user

        if ($userData) {
            $password = $userData->getPassword();
//            $roles = unserialize($userData->getRoles());
            $roles = ['ROLE_USER'];

            return new WebCurrentUser($username, $password, $roles);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebCurrentUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Myxhop\Bundle\WebBundle\Security\WebCurrentUser';
    }
}