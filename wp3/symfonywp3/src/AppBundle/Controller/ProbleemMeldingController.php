<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Probleemmelding;
use AppBundle\Form\ProbleemMeldingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

class ProbleemMeldingController extends Controller
{
/*
    /**
     * @Route("/show")
     */
/*
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $probleemMelding = $em->getRepository(Probleemmelding::class)->find($id);

        return $this->render('AppBundle:ProbleemMelding:show.html.twig', array(
            'probleemMelding' => $probleemMelding
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", requirements={"id": "\d+"}, name="probleemMelding_edit")
     * @Method({"GET", "POST"})
     */
/*
    public function editAction(Probleemmelding $probleemMelding, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProbleemMeldingType::class, $probleemMelding);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            $this->addFlash('success', 'updated_successfully');

            return $this->redirectToRoute('probleemMelding_edit', ['id' => $probleemMelding->getId()]);
        }

        return $this->render('ProbleemMelding/edit.html.twig', [
            'probleemMelding' => $probleemMelding,
            'form' => $form->createView(),
        ]);
    }
*/
}
