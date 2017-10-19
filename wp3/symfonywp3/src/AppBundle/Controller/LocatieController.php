<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Locatie;
use AppBundle\Entity\Probleemmelding;
use AppBundle\Entity\Statusmelding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LocatieController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $locaties= $em->getRepository(Locatie::class)->findAll();

        return $this->render('AppBundle:Locatie:index.html.twig', array(
            'locaties' => $locaties
        ));
    }

    /**
     * @Route("/show/{id}", requirements={"id": "\d+"}, name="locatie_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $probleemMeldingen= $em->getRepository(Probleemmelding::class)->findBy(
            array('locatieid' => $id)
        );
         $statusMeldingen = $em->getRepository(Statusmelding::class)->findBy(
             array('locatieid' => $id)
         )  ;
        return $this->render('AppBundle:Locatie:show.html.twig', array(
            'probleemMeldingen' => $probleemMeldingen,
            'statusMeldingen' => $statusMeldingen
        ));

    }

}
