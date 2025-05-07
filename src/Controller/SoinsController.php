<?php

namespace App\Controller;

use App\Entity\Soins;
use App\Form\SoinsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/soins')]
final class SoinsController extends AbstractController
{
    #[Route('index', name: 'app_soins_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $soins = $entityManager
            ->getRepository(Soins::class)
            ->findAll();

        return $this->render('soins/index.html.twig', [
            'soins' => $soins,
        ]);
    }

    #[Route('/new', name: 'app_soins_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $soin = new Soins();
        $form = $this->createForm(SoinsType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($soin);
            $entityManager->flush();

            return $this->redirectToRoute('app_soins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soins/new.html.twig', [
            'soin' => $soin,
            'form' => $form,
        ]);
    }

    #[Route('/{idCategSoins}', name: 'app_soins_show', methods: ['GET'])]
    public function show(Soins $soin): Response
    {
        return $this->render('soins/show.html.twig', [
            'soin' => $soin,
        ]);
    }

    #[Route('/{idCategSoins}/edit', name: 'app_soins_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Soins $soin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoinsType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_soins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soins/edit.html.twig', [
            'soin' => $soin,
            'form' => $form,
        ]);
    }

    #[Route('/{idCategSoins}', name: 'app_soins_delete', methods: ['POST'])]
    public function delete(Request $request, Soins $soin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soin->getIdCategSoins(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($soin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_soins_index', [], Response::HTTP_SEE_OTHER);
    }
}
