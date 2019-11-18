<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Zend\Code\Generator\DocBlock\Tag\ReturnTag;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Form\ArticleType;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdminController extends AbstractController
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
     * @Route("/vide", name="vide.blog")
     */
    public function vide()
    {
        return $this->render('blog/underconstruct.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

         /**
     * @Route("/contact", name="blog.contact")
     */
    public function contact()
    {     
        return $this->render('blog/contact.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }


    /** 
     * @Route("/blog/nouveau", name="article.nouv")
    */
    public function nouvelArticle(Request $request, ObjectManager $manager)
    {
        $article = new Article();
       // $form = $this->createFormBuilder($article)
        $form = $this->createForm(ArticleType::class, $article);
    
        // Creer 1 formulaire lié à mon article;
    /*                ->add('title', TextType::class, [
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
    */

    // SIMPLIFICATION DE LA TACHE
    /*                   ->add('title')
                        ->add('Categorie', EntityType::class, [
                                'class' => Categorie::class,
                                'choice_label' => 'titre'
                         ])
                       ->add('content')                
                       
                       ->add('image')    
                       ->getForm();
    */
        $form->handleRequest($request);   // Le Request
        
        //var_dump($article);

        if($form->isSubMitted() && $form->isValid()){ // Soumission du Formulaire
            
            $article->setCreatedAt(new \DateTime()); // Création de la date de l'article
            
           // $article->setCategorie(new Categorie()); // Création de la date de l'article
            /*  if ($article->getCategorie() === $this) {
                $article->setCategorie(null);
            }*/
          
            // $article->setCategorie_id(0);

            $manager->persist($article); // Persistancede mon article
            $manager->flush(); // Enregistrement de l'article dans la BD

            return $this->redirectToRoute('blog_show', ['id'=>$article->getId()]); // Redirection vers l'article
        }
        
        return $this->render('blog/nouveau.html.twig', [
               'formCreatArt' => $form->createView()
               ]);
    }

/** 
     * @Route("/blog/{id}/modif", name="article.modif")
    */
    public function modifArticle(Article $article, Request $request, ObjectManager $manager)
    {
       // $article = new Article();
        $form = $this->createFormBuilder($article) 
                       ->add('title')
                       ->add('content')                
                       ->add('image')    
                    //   ->add('categorie')
                   //    ->add('Categorie')

                       ->getForm();

        $form->handleRequest($request);   // Le Request
        
        //var_dump($article);

        if($form->isSubMitted() && $form->isValid()){ // Soumission du Formulaire
            
           // $article->setCategorie(new Categorie()); // Création de la date de l'article
           if ($article->getCategorie() === $this) {
            $article->setCategorie(null);
        }
          
            // $article->setCategorie_id(0);

            $manager->persist($article); // Persistancede mon article
            $manager->flush(); // Enregistrement de l'article dans la BD

            return $this->redirectToRoute('blog_show', ['id'=>$article->getId()]); // Redirection vers l'article
        }
        
        return $this->render('blog/modif.html.twig', [
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
