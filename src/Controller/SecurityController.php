<?php

namespace App\Controller;

use App\Form\SecurityType;
use App\Entity\User;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\BrowserKit\Request as SymfonyRequest;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


// use Symfony\Component\BrowserKit\Request as SymfonyRequest;

//use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{   
     /**
     * @Route("/admin/user/blog", name="user.liste")
     */
    public function listUser(PaginatorInterface $paginator, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        
        $user = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );

        
        return $this->render('security/liste.html.twig', [
            'user'=>$user
        ]);
    }


    /**
     * @Route("/admin/user/nouveau", name="user.nouveua")
     */
    public function nouvelUser(ObjectManager $manager, Request $request)
    {
        $user= new User();
        $form = $this->createFormBuilder($user)
                        ->add('username')
                        ->add('password')
                        ->add('email')
                        ->getForm();

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()){
           $manager->persist($user);
           $manager->flush();
        }
    	return $this->render('security/nouveau.html.twig', [
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
