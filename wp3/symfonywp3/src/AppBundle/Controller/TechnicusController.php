<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Probleemmelding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TechnicusController extends Controller
{
    /**
     * @Route("/technicus_toegekendeProblemen" , name="probleemMeldingenTechnicus_show")
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
     * @Route("/technicus_probleemAfhandelen/{id}" , requirements={"id": "\d+"}, name="probleemAfhandelen")
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

    /**
     * @Route("/technicus_showProbleemMeldingenTechnicus", name="show_ProbleemMeldingenTechnicus")
     */
    public function showProbleemMeldingenAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $probleemMeldingen= $entityManager->getRepository(Probleemmelding::class)->findBy(
            array('afgehandeld' => 0 , 'userid' => 0)
        );
        return $this->render('AppBundle:Technicus:show.html.twig', array(
            'probleemMeldingen' => $probleemMeldingen
        ));
    }

    /**
     * @Route("/technicus_toekennenProbleemMelding/{id}" , requirements={"id": "\d+"}, name="toekennen_ProbleemMelding")
     */
    public function toekennenProbleemMeldingAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $probleemmelding = $entityManager->getRepository(Probleemmelding::class)->find($id);

        $probleemmelding->setUserid($this->getUser()->getId());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('show_ProbleemMeldingenTechnicus');
    }
}
