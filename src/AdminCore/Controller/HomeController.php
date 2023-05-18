<?php

namespace App\AdminCore\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/admin', name: 'admin_core_home')]
    public function index(): Response
    {
        return $this->render('admincore/base.html.twig');
    }
}