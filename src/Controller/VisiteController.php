<?php

namespace App\Controller;

use App\Entity\Visite;
use App\Entity\Infirmiere;
use App\Entity\PersonneLogin;
use App\Form\VisiteType;
use App\Repository\VisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VisiteController extends AbstractController
{
    #[Route('/api/visites', name: 'api_visites', methods: ['GET'])]
    public function apiVisites(VisiteRepository $visiteRepository): JsonResponse
    {
        $visites = $visiteRepository->findAll();

        $events = [];

        foreach ($visites as $visite) {
            $patient = $visite->getPatient()?->getIdPersonne();

            $events[] = [
                'id' => $visite->getId(),
                'title' => $patient
                    ? $patient->getNom() . ' ' . $patient->getPrenom()
                    : 'Visite',
                'start' => $visite->getDatePrevue()->format('Y-m-d\TH:i:s'),
                'url' => $this->generateUrl('visite_detail', ['id' => $visite->getId()])
            ];
        }

        return new JsonResponse($events);
    }

    #[Route('/visite', name: 'app_visite')]
    public function index(VisiteRepository $visiteRepository): Response
    {
        $visites = $visiteRepository->findAll();

        return $this->render('visite/index.html.twig', [
            'visites' => $visites,
        ]);
    }

    #[Route('/new', name: 'visite_add')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $visite = new Visite();
    
        $personneLogin = $this->getUser();

    if (!$personneLogin instanceof PersonneLogin) {
        throw new \Exception('L\'utilisateur n\'est pas un utilisateur valide.');
    }

    $infirmiere = $em->getRepository(Infirmiere::class)->findOneBy(['personneLogin' => $personneLogin]);

    if (!$infirmiere) {
        throw new \Exception('L\'utilisateur n\'est pas un infirmier valide.');
    }

    $visite->setInfirmiere($infirmiere);


        $form = $this->createForm(VisiteType::class, $visite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($visite);
            $em->flush();

            $this->addFlash('success', 'Visite ajoutée avec succès.');

            return $this->redirectToRoute('infirmiere_dashboard');
        }

        return $this->render('visite/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/infirmiere/visite/{id}/edit', name: 'visite_edit')]
    public function editVisite(Request $request, Visite $visite, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $compteRendu = $request->request->get('compte_rendu');
            $visite->setCompteRenduInfirmiere($compteRendu);

            $em->persist($visite);
            $em->flush();

            return $this->redirectToRoute('infirmiere_dashboard');
        }

        return $this->render('infirmiere/edit_visite.html.twig', [
            'visite' => $visite,
        ]);
    }

    #[Route('/delete/{id}', name: 'visite_delete', methods: ['GET'])]
    public function delete(Visite $visite, EntityManagerInterface $em): Response
    {
        $em->remove($visite);
        $em->flush();

        $this->addFlash('success', 'Visite supprimée avec succès.');

        return $this->redirectToRoute('infirmiere_dashboard'); 
    }
}
