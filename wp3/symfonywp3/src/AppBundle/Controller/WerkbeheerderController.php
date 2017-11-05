<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Probleemmelding;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WerkbeheerderController extends Controller
{

    /**
     * @Route("/showProbleemMeldingen", name="show_ProbleemMeldingen")
     */
    public function showProbleemMeldingenAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $probleemMeldingen= $entityManager->getRepository(Probleemmelding::class)->findBy(
            array('afgehandeld' => 0 )
        );
        return $this->render('AppBundle:Werkbeheerder:show.html.twig', array(
            'probleemMeldingen' => $probleemMeldingen
        ));
    }

    /**
     * @Route("/showTechnicus/{id}" , requirements={"id": "\d+"}, name="show_technicus")
     */
    public function showTechnicusAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $technicussen= $entityManager->getRepository(User::class)->findBy(
            array('rolesstring' => 'ROLE_TECHNICUS' )
        );
        return $this->render('AppBundle:Werkbeheerder:toekennen_technicus.html.twig', array(
            'technicussen' => $technicussen,
            'probleemmeldingId' => $id
        ));
    }

    /**
     * @Route("/toekennenTechnicus/{probleemmeldingId}/{technicusId}" , name="toekennen_technicus")
     */
    public function ToekennenTechnicsAction($probleemmeldingId, $technicusId)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $probleemmelding = $entityManager->getRepository(Probleemmelding::class)->find($probleemmeldingId);

        $probleemmelding->setUserid($technicusId);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('show_ProbleemMeldingen');
    }

    /**
     * @Route("/deleteTechnicusToekenning/{id}" , requirements={"id": "\d+"}, name="delete_TechnicusToekenning")
     */
    public function deleteTechnicusToekenningAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $probleemmelding= $entityManager->getRepository(Probleemmelding::class)->find($id);
        $probleemmelding->setUserid(0);
        $entityManager->flush();

        return $this->redirectToRoute('show_ProbleemMeldingen');
    }

}
