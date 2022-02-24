<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/accueil', name: 'accueil')]
class HomeController extends AbstractController
{
    #[Route('/', name: '_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/accueil.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}