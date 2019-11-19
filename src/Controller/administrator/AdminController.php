<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Article;

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
             9 /*limit per page*/     );

        
        return $this->render('administrator/article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles'=>$articles
        ]);
    }
}
