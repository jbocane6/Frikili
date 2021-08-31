<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Config\SecurityConfig;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'registro')]
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();/*Creates new user*/
        $form = $this->createForm(UserType::class, $user);/*create form with the fields indicated in Form/UserTpe.php*/
        $form->handleRequest($request);//pass the Symfony\Component\HttpFoundation\Request object to handleRequest(): to process form data 
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($passwordEncoder->encodePassword($user, $form['password']->getData()));//encode (hash) the password
            $em = $this->getDoctrine()->getManager();//It’s responsible for saving objects to, and fetching objects from, the database.
            $user->setBaneado(false);//true or false
            $user->setRoles(['ROLE_USER']);//ROLE_USER or ROLE_ADMIN
            $em->persist($user);//tells Doctrine to “manage” the $user object. This does not cause a query to be made to the database.
            $em->flush();// executes an INSERT query, creating a new row in the user table.
            $this->addFlash('exito', 'Se ha registrado exitosamente');//mesage to show in index.html.swig if succeeded
            return $this->redirectToRoute('registro');//redirect to the page describe to continue.
        }
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
            'variablename' => 'ñaña',/*Adding new variable to array*/
            'formulario' => $form->createView(),//return form
        ]);/*'RegistroController' = text to be stored in {{ controller_name }} in index.html.twig to be shown in page*/
    }
}
