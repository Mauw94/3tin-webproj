<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StatusMeldingController extends Controller
{
    /**
     * @Route("/show")
     */
    public function showAction()
    {
        return $this->render('AppBundle:StatusMelding:show.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:StatusMelding:edit.html.twig', array(
            // ...
        ));
    }

}
