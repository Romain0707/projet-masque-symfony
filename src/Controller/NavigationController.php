<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\MasqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class NavigationController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(MasqueRepository $masqueRepository): Response
    {

        $masque = $masqueRepository->findBy([], ['id' => 'DESC'], 4);
        return $this->render('pages/index.html.twig', [
            'masques' => $masque,
        ]);
    }

    #[Route('/galerie', name: 'galerie')]
    public function galerie(MasqueRepository $masqueRepository): Response
    {   
        $masque = $masqueRepository->findAll();
        return $this->render('pages/galerie.html.twig', [
            'masques' => $masque,
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        $data = $form->getData();

        $email= (new Email())
            ->from($form->get('email')->getData())
            ->to('admin@admin.fr')
            ->subject('Contact depuis le site Collection de Masque')
            ->text(
                "Nom: {$data['name']}\n".
                "Email: {$data['email']}\n\n".
                "Message: {$data['message']}\n"
            );
            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('contact');
        }

        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/galerie/filters', name: 'galeriefiltered', methods: ['GET'])]
    public function filter(MasqueRepository $masqueRepository, Request $request): JsonResponse
    {   
        $filter = $request->get('filter', 'all');

        $masque = match($filter) {
            'asc' => $masqueRepository->findBy([], ['id' => 'ASC']),
            'desc' => $masqueRepository->findBy([], ['id' => 'DESC']),
            default => $masqueRepository->findAll(),
        };

        return $this->json([
            'html' => $this->renderView('partial/article.html.twig', [
                'masques' => $masque
                ]),
        ]);
    }
}
