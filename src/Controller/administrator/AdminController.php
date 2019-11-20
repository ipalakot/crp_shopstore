<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Article;
use App\Entity\Categorie;

class AdminController extends AbstractController
{
    /**
     * @Route("/administrator/admin", name="admin")
     */
    public function index()
    {
        return $this->render('administrator/admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

     /**
     * @Route("/admininsitrator/article/blog", name="admin.article.blog")
     */
    public function listArticles(PaginatorInterface $paginator, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        
        $articles = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             18 /*limit per page*/     );

        
        return $this->render('administrator/article/admin.article.blog.html.twig', [
            'controller_name' => 'ArticleController',
            'articles'=>$articles
        ]);
    }
    /**
     * @Route("/admininsitrator/categorie/blog", name="admin.categorie.blog")
     */
    public function categorieList(PaginatorInterface $paginator, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        
        $categories = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             18 /*limit per page*/     );

        
        return $this->render('administrator/categorie/admin.categorie.blog.html.twig', [
            'controller_name' => 'ArticleController',
            'categories'=>$categories
        ]);
    }
}
