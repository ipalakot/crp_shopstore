<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livres;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        
        $repo = $this->getDoctrine()->getRepository(Livres::class);
        $livres = $paginator->paginate(
            $repo ->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/     );

        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
            'livres'=>$livres
        ]);
    }
}