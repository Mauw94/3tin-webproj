<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Statusmelding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StatusMeldingController extends Controller
{
    /**
     * @Route("/showStatusMelding/{id}", requirements={"id": "\d+"}, name="statusMelding_show")
     */
    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $statusMelding = $entityManager->getRepository(Statusmelding::class)->find($id);

        return $this->render('AppBundle:StatusMelding:show.html.twig', array(
            'statusMelding' => $statusMelding
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
