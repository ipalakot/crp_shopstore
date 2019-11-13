<?php

namespace App;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        //
    }
}