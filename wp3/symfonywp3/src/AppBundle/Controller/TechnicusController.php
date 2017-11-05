<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Probleemmelding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TechnicusController extends Controller
{
    /**
     * @Route("/toegekendeProblemen" , name="probleemMeldingenTechnicus_show")
     */
    public function toegekendeProblemenAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $probleemMeldingen= $entityManager->getRepository(Probleemmelding::class)->findBy(
            array('userid' => $id)
        );
        return $this->render('AppBundle:Technicus:toegekende_problemen.html.twig', array(
            'probleemMeldingen' => $probleemMeldingen
        ));
    }

    /**
     * @Route("/probleemAfhandelen/{id}" , requirements={"id": "\d+"}, name="probleemAfhandelen")
     */
    public function probleemAfhandelen($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $probleemMelding = $entityManager->getRepository(Probleemmelding::class)->find($id);
        if (!$probleemMelding) {
            throw $this->createNotFoundException(
                'No probleemmelding found for id '.$id
            );
        }
        $probleemMelding->setAfgehandeld(true);
        $entityManager->flush();

        return $this->redirectToRoute('probleemMeldingenTechnicus_show');
    }
}
