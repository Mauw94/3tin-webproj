<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Probleemmelding;
use AppBundle\Form\ProbleemMeldingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use AppBundle\Entity\Score;

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
    public function addScore($id,$score){
        //$id = id from url
        //$score = score from url
        $entityManager = $this->getDoctrine()->getManager();

        $score=$entityManager->getRepository(Score::class)->findBy(
            array(
                'idprobleemmelding'=> $id
            )

        );
       if ($score[0] ==null){
           echo 'create new score';
       }else{
           print_r($score[0]);
           $score[0]['aantalscores']= $score['aantalscores']+1;
           $score[0]['totalescore']= $score['totalescore']+$score;
           echo 'update score';
           print_r($score[0]);
       }
    }
}
