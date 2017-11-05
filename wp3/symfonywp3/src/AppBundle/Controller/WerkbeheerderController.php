<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WerkbeheerderController extends Controller
{
    /**
     * @Route("/showTechnicus/{id}" , requirements={"id": "\d+"}, name="show_technicus")
     */
    public function showTechnicusAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $technicussen= $entityManager->getRepository(User::class)->findAll();
        return $this->render('AppBundle:Werkbeheerder:toekennen_technicus.html.twig', array(
            'technicussen' => $technicussen
        ));
    }

    /**
     * @Route("/toekennenTechnicus/{probleemmeldingId}/{technicusId}" , name="toekennen_technicus")
     */
    public function ToekennenTechnicsAction($probleemmeldingId, $technicusId)
    {
        return $this->render('AppBundle:Werkbeheerder:toekennen_technicus.html.twig', array(

        ));
    }

}
