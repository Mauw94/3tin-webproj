<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;

class GenerateUserController extends Controller
{
    /**
     * @Route("/makeUsers")
     */
    public function makeUsersAction()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $user = new User();
            $user->setUserName('admin1');
            $user->setRolesString(
                'ROLE_ADMIN ROLE_USER');
            $password = 'a1';
            $encoder = $this->container->
            get('security.password_encoder');
            $encoded = $encoder->encodePassword($user,
                $password);
            $user->setPassword($encoded);
            $em->persist($user);
            $em->flush();
            return new Response('Created user');
        }
    }
}
