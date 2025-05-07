<?php

// src/Controller/InfirmiereController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VisiteRepository;
use App\Repository\PersonneLoginRepository;
use App\Entity\PersonneLogin;
use App\Entity\Infirmiere;
use App\Form\InfirmiereType;
use Doctrine\ORM\EntityManagerInterface;

final class InfirmiereController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager; 
    }

    #[Route('/infirmiere/login', name: 'infirmiere_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('infirmiere/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }
    #[Route('/infirmiere/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }

    #[Route('/infirmiere/dashboard', name: 'infirmiere_dashboard')]
    public function dashboard(VisiteRepository $visiteRepository): Response
    {
        $personne = $this->getUser(); 
    
        if (!$personne instanceof PersonneLogin) {
            throw $this->createAccessDeniedException("Vous n'avez pas les rôles pour accéder cette compte.");
        }
    
        $infirmiere = $this->entityManager
                           ->getRepository(Infirmiere::class)
                           ->findOneBy(['personneLogin' => $personne]);
    
        if (!$infirmiere) {
            throw $this->createAccessDeniedException("Infirmière non trouvée pour ce compte.");
        }
    
        // Fetch all visites for this infirmiere
        $visites = $visiteRepository->findVisitesWithPatientInfo($infirmiere);

    
        return $this->render('infirmiere/dashboard.html.twig', [
            'visites' => $visites,  
        ]);
    }

    #[Route('/infirmiere/visite/{id}', name: 'visite_detail')]
    public function visiteDetail(int $id, Request $request, VisiteRepository $visiteRepository): Response
    {
        $visite = $visiteRepository->find($id);

        if (!$visite) {
            throw $this->createNotFoundException('Visite non trouvée.');
        }

        $personne = $this->getUser();
        $infirmiere = $this->entityManager
                        ->getRepository(Infirmiere::class)
                        ->findOneBy(['personneLogin' => $personne]);

        if (!$infirmiere || $visite->getInfirmiere()->getId() !== $infirmiere->getId()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas accéder à cette visite.");
        }

        
        if ($request->isMethod('POST')) {
            foreach ($visite->getSoinsVisite() as $sv) {
                $key = 'realise_' . $sv->getSoins()->getId();
                $sv->setRealise($request->request->get($key) === 'on');
            }

            $this->entityManager->flush();
            $this->addFlash('success', 'Soins mis à jour.');
        }

        return $this->render('infirmiere/visite_detail.html.twig', [
            'visite' => $visite,
        ]);
    }
    

    #[Route('/infirmiere/visites/json', name: 'infirmiere_visites_json')]
    public function visitesJson(VisiteRepository $visiteRepository): Response
    {
        $personne = $this->getUser();
    
        if (!$personne instanceof PersonneLogin) {
            return $this->json(['error' => 'Access denied'], Response::HTTP_UNAUTHORIZED);
        }
    
        $infirmiere = $this->entityManager
                           ->getRepository(Infirmiere::class)
                           ->findOneBy(['personneLogin' => $personne]);
    
        if (!$infirmiere) {
            return $this->json(['error' => 'Infirmiere not found'], Response::HTTP_NOT_FOUND);
        }
    
        $visites = $visiteRepository->findVisitesWithDetails($infirmiere);
    

        if (empty($visites)) {
            return $this->json(['message' => 'No visites found'], 200);
        }
    
        $events = array_map(function ($visite) {

            $patient = $visite->getPatient();
            $patientName = $patient ? $patient->getInformationsMedicales() : 'Inconnu'; 
            return [
                'id' => $visite->getId(),
                'title' => $visite->getPatient()->getInformationsMedicales() ?? 'Sans nom',
                'start' => $visite->getDatePrevue()->format('Y-m-d\TH:i:s'),
                'end' => $visite->getDateReelle()?->format('Y-m-d\TH:i:s')
            ];
        }, $visites);
    
        return $this->json($events);
    } 
}