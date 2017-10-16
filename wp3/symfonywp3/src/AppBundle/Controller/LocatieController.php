<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Locatie;
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

        return $this->render('AppBundle:Locatie:index.html.twig', ['locaties' => $locaties]);
    }

    /**
     * @Route("/show")
     */
    public function showAction($id)
    {
        return $this->render('AppBundle:Locatie:show.html.twig', array(
            // ...
        ));
    }

}
