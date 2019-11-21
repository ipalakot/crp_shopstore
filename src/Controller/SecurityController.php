<?php

namespace App\Controller;

use App\Form\SecurityType;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request as SymfonyRequest;
// use Symfony\Component\BrowserKit\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{   
    /**
     * @Route("/login", name="login")
     */
    public function login(ObjectManager $manager, Request $request)
    {
        
        // get the login error if there is one
        // $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        //$lastUsername = $authenticationUtils->getLastUsername();
        /*    
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]); */

        $user= new User();
        $form = $this->createForm(SecurityType::class, $user);

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()){
           $manager->persist($user);
           $manager->flush();
        }
    	return $this->render('security/enregistrement.html.twig', [
            'form' => $form->createView()
        ]);
   }
    
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        //
    }
}
