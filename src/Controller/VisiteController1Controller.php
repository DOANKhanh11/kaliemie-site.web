<?php

namespace App\Controller;

use App\Entity\Visite;
use App\Form\Visite1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/visite/controller1')]
final class VisiteController1Controller extends AbstractController
{
    #[Route(name: 'app_visite_controller1_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $visites = $entityManager
            ->getRepository(Visite::class)
            ->findAll();

        return $this->render('visite_controller1/index.html.twig', [
            'visites' => $visites,
        ]);
    }

    #[Route('/new', name: 'app_visite_controller1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $visite = new Visite();
        $form = $this->createForm(Visite1Type::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($visite);
            $entityManager->flush();

            return $this->redirectToRoute('app_visite_controller1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('visite_controller1/new.html.twig', [
            'visite' => $visite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_visite_controller1_show', methods: ['GET'])]
    public function show(Visite $visite): Response
    {
        return $this->render('visite_controller1/show.html.twig', [
            'visite' => $visite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_visite_controller1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Visite $visite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Visite1Type::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_visite_controller1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('visite_controller1/edit.html.twig', [
            'visite' => $visite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_visite_controller1_delete', methods: ['POST'])]
    public function delete(Request $request, Visite $visite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visite->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($visite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_visite_controller1_index', [], Response::HTTP_SEE_OTHER);
    }
}
