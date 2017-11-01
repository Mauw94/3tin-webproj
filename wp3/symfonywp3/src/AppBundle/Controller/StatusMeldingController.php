<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Statusmelding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Psr\Log\LoggerInterface;

class StatusMeldingController extends Controller
{
     /**
     * @Route("/edit")
     */
    public function editAction(LoggerInterface $logger)
    {
        //$logger = $this->get('logger');
        $logger->info('Edit Action statusmelding controller');

        return $this->render('AppBundle:StatusMelding:edit.html.twig', array(
            // ...
        ));
    }

}
