<?php

namespace App\Controller;

use App\Entity\Colors;
use App\Entity\Commentary;
use App\Entity\Masque;
use App\Form\ColorsType;
use App\Form\CommentaryType;
use App\Form\MasqueType;
use App\Repository\MasqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MasqueController extends AbstractController
{
    #[Route('/masque/add', name: 'masque_add')]
    #[Route('/masque/modify/{id}', name: 'masque_modify')]
     public function index(Security $security, ?Masque $masque, ?Colors $colors , Request $request, EntityManagerInterface $entityManager): Response
    {

        if(!$masque){
            $masque = new Masque;
        }

        if(!$colors){
            $colors = new Colors;
        }

        $form = $this->createForm(MasqueType::class,$masque);
        $form->handleRequest($request);

        $formcolors = $this->createForm(ColorsType::class,$colors);
        $formcolors->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            if($masque->getUser() !== null) {
                if($security->getUser()->getId() !== $masque->getUser()->getId()){
                    $this->addFlash('error', 'Vous ne pouvez pas modifier ce masque');
                     
                    return $this->redirectToRoute('home');
                }
            }
            $masque->setUser($security->getUser());
            $entityManager->persist($masque);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        if($formcolors->isSubmitted() && $formcolors->isValid()) {

            $entityManager->persist($colors);

            $entityManager->flush();

            $this->addFlash('success', 'Couleur ajouté avec succès');
            
            if($masque->getId() !== null) {
                return $this->redirectToRoute('masque_modify', ['id' => $masque->getId()]);
            }
            return $this->redirectToRoute('masque_add');
        }

        return $this->render('masque/masque_add.html.twig', [
            'form' => $form->createView(), 
            'formcolors' => $formcolors->createView(),
            'isModification' => $masque->getId() !== null 
        ]);
    }

    #[Route('/masque/delete/{id}', name: 'masque_delete')]
    public function remove(Masque $masque, Request $request, EntityManagerInterface $entityManager)
    {
        
        if($this->isCsrfTokenValid('SUP'.$masque->getId(),$request->get('_token'))){
            $entityManager->remove($masque);
            $entityManager->flush();
            $this->addFlash('success','La suppression à été effectuée');
            return $this->redirectToRoute('home');
        }
    }

    #[Route('/masque/article/{id}', name: 'masque_article')]
    public function article(Masque $masque, ?Commentary $commentary, MasqueRepository $masqueRepository, Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        if(!$commentary){
            $commentary = new Commentary;
        }
        
        $form = $this->createForm(CommentaryType::class,$commentary);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $commentary->setUser($security->getUser());
            $commentary->setMasque($masque);

            $entityManager->persist($commentary);
            $entityManager->flush();

            return $this->redirectToRoute('masque_article', ['id' => $masque->getId()]);
        }

        $masque = $masqueRepository->findOneBy(['id' => $masque->getId()]);
        return $this->render('masque/masque_article.html.twig', [
            'masque' => $masque,
            'form' => $form->createView(),
        ]);
    }
}
