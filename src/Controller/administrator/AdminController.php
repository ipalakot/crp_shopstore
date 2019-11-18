<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
