<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use App\Repository\LicencieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cours', name: 'cours')]
class CoursController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(Request $request, EntityManagerInterface $entityManager, ): Response
    {
        $user = $this->getUser();
        $cours = new Cours();
        $heure= new \DateTime();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cours->setAuteur($user);
            $entityManager->persist($cours);
            $entityManager->flush();
            // do anything else you need here, like send an email
            return $this->redirectToRoute('accueil_accueil');
        }
        return $this->render('cours/cours.html.twig', [
            'coursFormulaire' => $form->createView(),
        ]);

    }

    #[Route('/afficher', name: '_afficher')]
    public function afficherCours(Request $request, EntityManagerInterface $entityManager,LicencieRepository $licencieRepository,
                                  CoursRepository $coursRepository): Response
    {
        $user = $this->getUser();
        $numeroDeLicence=$this->getUser()->getUserIdentifier();
        $licencie=$licencieRepository->findOneBy(['numeroDeLicence'=>$numeroDeLicence]);
        $niveau=$licencie->getNiveau();
        $cours = new Cours();
        $cours=$coursRepository->findAll();
        return $this->render('cours/afficherCours.html.twig',
            compact('cours','niveau'),
        );

    }

    #[Route('/inscription/{id}', name: '_inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager, CoursRepository $coursRepository,
                                LicencieRepository $licencieRepository,$id): Response
    {
        $user = $this->getUser();
        $cours=$coursRepository->find($id);
        $numeroDeLicence=$this->getUser()->getUserIdentifier();
        $licencie=$licencieRepository->findOneBy(['numeroDeLicence'=>$numeroDeLicence]);
        $licencie->addCoursInscrit($cours);
        $entityManager->persist($licencie);
        $entityManager->flush($licencie);
        return $this->redirectToRoute('cours_afficher');


    }
    #[Route('/desister/{id}', name: 'desister')]
    public function desinscription(Request $request, EntityManagerInterface $entityManager, CoursRepository $coursRepository,
                                   $id, LicencieRepository $licencieRepository): Response
    {
        $user = $this->getUser();
        $cours=$coursRepository->find($id);
        $numeroDeLicence=$this->getUser()->getUserIdentifier();
        $licencie=$licencieRepository->findOneBy(['numeroDeLicence'=>$numeroDeLicence]);
        $licencie->removeCoursInscrit($cours);
        $entityManager->persist($licencie);
        $entityManager->flush($licencie);


        return $this->redirectToRoute('cours_afficher');

    }

    #[Route('/afficherListe{id}', name: '_liste')]
    public function afficherInscrit(Request $request, EntityManagerInterface $entityManager,LicencieRepository $licencieRepository,
                                  CoursRepository $coursRepository,$id): Response
    {
        $cours = new Cours();
        $cours=$coursRepository->find($id);
        $inscrits=$cours->getLicencies();
        return $this->render('cours/afficherList.html.twig',
            compact('inscrits', 'cours'),
        );
    }
}
