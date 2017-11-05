<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
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

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $user->setPassword($this->encodePassword($user, $user->getPassword()));
            $user->setRolesString('ROLE_TECHNICUS');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('AppBundle:Admin:add_technicus.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/showTechnicussen" , name="show_technicussen")
     */
    public function showTechnicusAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $technicussen= $entityManager->getRepository(User::class)->findBy(
            array('rolesstring' => 'ROLE_TECHNICUS' )
        );
        return $this->render('AppBundle:Admin:showTechnicussen.html.twig', array(
            'technicussen' => $technicussen
        ));
    }

    /**
     * @Route("/editTechnicus/{id}" , requirements={"id": "\d+"}, name="edit_technicus")
     */
    public function editTechnicusAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $technicus= $entityManager->getRepository(User::class)->find($id);

        $form = $this->createForm(UserType::class, $technicus);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $technicus->setPassword($this->encodePassword($technicus, $technicus->getPassword()));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('show_technicussen');
        }

        return $this->render('AppBundle:Admin:edit_technicus.html.twig', [
            'user' => $technicus,
            'form' => $form->createView(),
        ]);
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');
        $encodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }
}
