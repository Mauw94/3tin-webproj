<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Probleemmelding;
use AppBundle\Form\ProbleemMeldingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use AppBundle\Entity\Score;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;

class ProbleemMeldingController extends Controller
{
     /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", requirements={"id": "\d+"}, name="probleemMelding_edit")
     */
    public function editAction(LoggerInterface $logger,Probleemmelding $probleemMelding, Request $request)
    {
        //$logger = $this->get('logger');
        $logger->info('Edit Action probleemmelding controller');

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
     * @Route("/{id}/score/{scoreP}", requirements={"id": "\d+"}, name="score_edit")
     */
    public function addScore(LoggerInterface $logger,$id,$scoreP){
        //$logger = $this->get('logger');
        $logger->info('Add Score probleemmelding controller');

        $entityManager = $this->getDoctrine()->getManager();

        $score=$entityManager->getRepository(Score::class)->findBy(
            array(
                'idprobleemmelding'=> $id
            )

        );
       if ($score==null || $score[0] ==null){
           $newScore = new Score($id,1,$scoreP);
           $entityManager->persist($newScore);
           $entityManager->flush();
       }else{
           $score[0]->setTotalescore($score[0]->getTotalescore()+$scoreP);
           $score[0]->setAantalscores($score[0]->getAantalscores()+1);
           $entityManager->merge($score[0]);
           $entityManager->flush();

       }
       return new Response();

    }
}
