<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Zend\Code\Generator\DocBlock\Tag\ReturnTag;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        
        $articles = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );

        
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=>$articles
        ]);
    }

    /** 
     * @Route("/blog/nouveau", name="nouv.article")
    */
    public function nouvelArticle(Request $request, ObjectManager $manager)
    {
        $article = new Article();
        $form = $this->createFormBuilder($article) // Creer 1 formulaire lié à mon article;
                    ->add('title', TextType::class, [
                        'attr' => ['maxlength' => 2,
                        'class'=>'form-control'
                        ]
                        ])

                    ->add('content', TextareaType::class, [
                        'attr' => ['placeholder' => "",
                        'class'=>'form-control']
                        ])
                    
                    ->add('image', TextType::class, [
                            'attr' => ['placeholder' => "",
                            'class'=>'form-control']])
                    
                        
                    
                    ->getForm();

        return $this->render('blog/nouveau.html.twig', [
               'formCreatArt' => $form->createView()
               ]);
    }


    
    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article= $repo->find($id);

        return $this->render('blog/show.html.twig', [
            'article'=>$article
        ]);
    }
}
