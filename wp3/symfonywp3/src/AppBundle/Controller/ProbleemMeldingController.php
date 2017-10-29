<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Probleemmelding;
use AppBundle\Form\ProbleemMeldingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

class ProbleemMeldingController extends Controller
{
     /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", requirements={"id": "\d+"}, name="probleemMelding_edit")
     */
    public function editAction(Probleemmelding $probleemMelding, Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProbleemMeldingType::class, $probleemMelding);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash('success', 'updated_successfully');

            return $this->redirectToRoute('probleemMelding_edit', ['id' => $probleemMelding->getId()]);
        }

        return $this->render('ProbleemMelding/edit.html.twig', [
            'probleemMelding' => $probleemMelding,
            'form' => $form->createView(),
        ]);
    }
    /**
     * Adds a new score.
     *
     * @Route("/{id}/score/{score}", requirements={"id": "\d+"}, name="score_edit")
     */
    public function addScore(Request $request){
        //$id = id from url
        //$score = score from url
        $id = 0;
        $entityManager = $this->getDoctrine()->getManager();

        print_r($request);
        $score=$entityManager->getRepository(Score::class)->findBy(
            array(
                'idprobleemmelding'=> $id
            )

        );
       if ($score ==null){
           echo 'create new score';
       }else{
           echo 'update score';
       }
    }
}
