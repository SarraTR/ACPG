<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    #[Route('/actualite', name: 'actualite')]
    public function index( EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();
        $actualite = new Actualite();
        $heure= new \DateTime('now');
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $actualite->setDateActu($heure);
            $actualite->setAuteur($user);
            $entityManager->persist($actualite);
            $entityManager->flush();
            return $this->redirectToRoute('accueil_accueil');
        }
        return $this->render('actualite/actualite.html.twig', [
            'actualiteFormulaire' => $form->createView(),
        ]);
    }
}
