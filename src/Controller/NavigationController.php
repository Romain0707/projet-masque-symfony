<?php

namespace App\Controller;

use App\Repository\MasqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NavigationController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(MasqueRepository $masqueRepository): Response
    {

        $masque = $masqueRepository->findFour();
        return $this->render('pages/index.html.twig', [
            'masques' => $masque,
        ]);
    }

    #[Route('/galerie', name: 'galerie')]
    public function galerie(MasqueRepository $masqueRepository): Response
    {   
        $masque = $masqueRepository->findFour();
        return $this->render('pages/galerie.html.twig', [
            'masques' => $masque,
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'NavigationController',
        ]);
    }
}
