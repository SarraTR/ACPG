<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use App\Repository\LicencieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/accueil', name: 'accueil')]
class HomeController extends AbstractController
{
    #[Route('', name: '_accueil')]
    public function index(LicencieRepository $licencieRepository): Response
    {
        if ($user=$this->getUser()) {
            $user = $this->getUser()->getUserIdentifier();
            $licencie = $licencieRepository->findOneBy(['numeroDeLicence' => $user]);
            $coursInscrits = $licencie->getCoursInscrits();
            return $this->render('accueil/index.html.twig', [
                compact('coursInscrits')
            ]);
        }else{
            return $this->render('accueil/index.html.twig');
        }
    }
}
