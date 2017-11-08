<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Locatie;
use AppBundle\Entity\Probleemmelding;
use AppBundle\Entity\Score;
use AppBundle\Entity\Statusmelding;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class LocatieController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction(Request $request, LoggerInterface $logger)
    {
        //$logger = $this->get('logger');
        $logger->info('Location constructor');

        $entityManager = $this->getDoctrine()->getManager();

        $dql = "SELECT bp FROM AppBundle:Locatie bp";
        $query = $entityManager->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',8)
        );


        return $this->render('AppBundle:Locatie:index.html.twig', array(
            'locaties' => $result
        ));
    }

    /**
     * @Route("/showProbleemMeldingen/{id}", requirements={"id": "\d+"}, name="probleemMeldingen_show")
     */
    public function showProbleemMeldingenAction($id,LoggerInterface $logger)
    {
        //$logger = $this->get('logger');
        $logger->info('Show Action location controller');

        $entityManager = $this->getDoctrine()->getManager();

        $probleemMeldingen= $entityManager->getRepository(Probleemmelding::class)->findBy(
            array('locatieid' => $id)
        );
           $scores=[];
            foreach ($probleemMeldingen as $probleem){
                $score=$entityManager->getRepository(Score::class)->findBy(
                    array(
                      'idprobleemmelding'=> $probleem->getId()
                    )

                );
                if($score != null&&$score[0]!= null){
                    $scores[]=$score[0];
                    $probleem->setScore($score[0]->getTotalescore()/$score[0]->getAantalScores());
                }

            }

        $locatie = $entityManager->getRepository(Locatie::class)->find($id);

        return $this->render('AppBundle:Locatie:show_ProbleemMeldingen.html.twig', array(
            'probleemMeldingen' => $probleemMeldingen,
            'locatie'=> $locatie
        ));
    }

    /**
     * @Route("/showStatusMeldingenLocatie/{id}", requirements={"id": "\d+"}, name="statusMeldingen_show")
     */
    public function showStatusMeldingenAction($id,LoggerInterface $logger)
    {
        //$logger = $this->get('logger');
        $logger->info('Show Action location controller');

        $entityManager = $this->getDoctrine()->getManager();

        $statusMeldingen = $entityManager->getRepository(Statusmelding::class)->findBy(
            array('locatieid' => $id)
        )  ;

        $locatie = $entityManager->getRepository(Locatie::class)->find($id);

        return $this->render('AppBundle:Locatie:show_StatusMeldingen.html.twig', array(
            'statusMeldingen' => $statusMeldingen,
            'locatie'=> $locatie
        ));

    }

}
