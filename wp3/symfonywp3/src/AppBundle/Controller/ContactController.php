<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ContactController extends Controller
{
    /**
     * @Route("/sendMail")
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendMailAction(\Swift_Mailer $mailer)
    {$message = \Swift_Message::newInstance()
        ->setSubject('Added Technicus')
        ->setFrom('dummyPXL@hotmail.com')
        ->setTo('dummyPXL@hotmail.com')
        ->setBody('Added Technicus');
        $this->get('mailer')->send($message);

        return $this->render('AppBundle:Contact:send_mail.html.twig', array(

        ));
    }

}
