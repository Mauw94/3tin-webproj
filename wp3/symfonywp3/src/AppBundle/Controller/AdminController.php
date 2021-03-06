<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class AdminController extends Controller
{

    /**
     * @Route("/admin_addTechnicus", name="addTechnicus")
     */
    public function addTechnicusAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user)
            ->add('picture', FileType::class, array(
                'label' => 'Picture (JPG file)'
            ))
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // $file stores the uploaded JPG file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $user->getPicture();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where JPG are stored
            $file->move(
                $this->getParameter('pictures_directory'),
                $fileName
            );

            // Update the 'picture' property to store the JPG file name
            // instead of its contents
            $user->setPicture($fileName);

            $user->setPassword($this->encodePassword($user, $user->getPassword()));
            $user->setRolesString('ROLE_TECHNICUS');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Added Technicus')
                ->setFrom('dummy@example.com')
                ->setTo('schooldemo@blackturtle.eu')
                ->setBody('You created a technicus with name: ' . $user->getUsername());
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:Admin:add_technicus.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin_showTechnicussen" , name="show_technicussen")
     */
    public function showTechnicusAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $technicussen = $entityManager->getRepository(User::class)->findBy(
            array('rolesstring' => 'ROLE_TECHNICUS')
        );
        return $this->render('AppBundle:Admin:showTechnicussen.html.twig', array(
            'technicussen' => $technicussen
        ));
    }

    /**
     * @Route("/admin_editTechnicus/{id}" , requirements={"id": "\d+"}, name="edit_technicus")
     */
    public function editTechnicusAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $technicus = $entityManager->getRepository(User::class)->find($id);
        $tmpPicture = $technicus->getPicture();
        $technicus->setPicture("");
        $form = $this->createForm(UserType::class, $technicus)
            ->add('picture', FileType::class, array(
                'label' => 'Picture (JPG file)',
                'required' => false
            ));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $file stores the uploaded JPG file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            if ($technicus->getPicture() != ""){
                $file = $technicus->getPicture();

                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                // Move the file to the directory where JPG are stored
                $file->move(
                    $this->getParameter('pictures_directory'),
                    $fileName
                );

                // Update the 'picture' property to store the JPG file name
                // instead of its contents
                $technicus->setPicture($fileName);
            } else {
                $technicus->setPicture($tmpPicture);
            }


            $technicus->setPassword($this->encodePassword($technicus, $technicus->getPassword()));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('show_technicussen');
        }

        return $this->render('AppBundle:Admin:edit_technicus.html.twig', [
            'user' => $technicus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin_deleteTechnicus/{id}" , requirements={"id": "\d+"}, name="delete_technicus")
     */
    public function deleteTechnicuseAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $technicus = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($technicus);
        $entityManager->flush();

        return $this->redirectToRoute('show_technicussen');
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');
        $encodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }
}
