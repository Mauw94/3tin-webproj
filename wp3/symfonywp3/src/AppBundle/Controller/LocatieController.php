<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Locatie;
use AppBundle\Entity\Probleemmelding;
use AppBundle\Entity\Score;
use AppBundle\Entity\Statusmelding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Psr\Log\LoggerInterface;

class LocatieController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction(LoggerInterface $logger)
    {
        //$logger = $this->get('logger');
        $logger->info('Location constructor');

        $entityManager = $this->getDoctrine()->getManager();
        $locaties= $entityManager->getRepository(Locatie::class)->findAll();

        return $this->render('AppBundle:Locatie:index.html.twig', array(
            'locaties' => $locaties
        ));
    }

    /**
     * @Route("/showLocatie/{id}", requirements={"id": "\d+"}, name="locatie_show")
     */
    public function showAction($id,LoggerInterface $logger)
    {
        //$logger = $this->get('logger');
        $logger->info('Show Action location controller');

        $entityManager = $this->getDoctrine()->getManager();
        $probleemMeldingen= $entityManager->getRepository(Probleemmelding::class)->findBy(
            array('locatieid' => $id)
        );
         $statusMeldingen = $entityManager->getRepository(Statusmelding::class)->findBy(
             array('locatieid' => $id)
         )  ;
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


        return $this->render('AppBundle:Locatie:show.html.twig', array(
            'probleemMeldingen' => $probleemMeldingen,
            'statusMeldingen' => $statusMeldingen
        ));

    }

}
