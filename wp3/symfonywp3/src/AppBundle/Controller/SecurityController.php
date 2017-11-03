<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="loginroute")
     */
    public function loginAction()
    {
        return $this->render('AppBundle:Security:login.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("login_check", name="checkroute")
     */
    public function loginCheckAction()
    {
    }

    /**
     * @Route("/quit", name= "quitroute")
     */
    public function quitAction()
    {
    }

}
