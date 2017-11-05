<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class AdminController extends Controller
{

    /**
     * @Route("/addTechnicus", name="addTechnicus")
     */
    public function addTechnicusAction(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $user->setPassword($this->encodePassword($user, $user->getPassword()));
            $user->setRolesString('ROLE_TECHNICUS');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('/index');
        }
        return $this->render('AppBundle:Admin:add_technicus.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function encodePassword(User $user, $plainPassword)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');
        $encodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }
}
