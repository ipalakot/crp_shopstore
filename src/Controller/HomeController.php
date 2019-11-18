<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Article;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @Route("/", name="accueil")
     */
    public function home(PaginatorInterface $paginator, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        
        $articles = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             3 /*limit per page*/     );

        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=>$articles
        ]);
    }

    
    /**
     * @Route("/vide", name="home.vide")
     */
    public function vide()
    {
        return $this->render('home/underconstruct.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /** 
     * @Route("/", name="crp")
    */
/*    public function index()
    {
        return $this ->render('home/blog.html.twig',[
            'title'=>"BIENVENUE SUR NOTRE SITE",
            'heure'=>"Il est : ",
        ]); 
   } */

            /**
     * @Route("/contact", name="home.contact")
     */
    public function contact()
    {     
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
