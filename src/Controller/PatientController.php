<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\SecurityController;
use Symfony\Component\Security\Core\Authorization\Annotation\IsGranted;

#[Route('/patient')]
final class PatientController extends AbstractController
{
    #[Route('/index',name:'app_patient_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $patients = $entityManager
            ->getRepository(Patient::class)
            ->findAll();

        return $this->render('patient/index.html.twig', [
            'patients' => $patients,
        ]);
    }

    #[Route('/new', name: 'app_patient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($patient);
            $entityManager->flush();

            return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_patient_show', methods: ['GET'])]
    public function show(int $id, PatientRepository $patientRepository): Response
    {
        $patient = $patientRepository->findOneBy(['personneLogin' => $id]);

        if (!$patient) {
            throw $this->createNotFoundException('Patient non trouvé.');
        }

        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }


    #[Route('/patient/{id}/edit', name: 'app_patient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patient $patient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('patient_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    #[Route('/patient/{id}/delete', name: 'app_patient_delete', methods: ['POST'])]
    public function delete(Request $request, Patient $patient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getPersonneLogin(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/dashboard', name: 'patient_dashboard', methods: ['GET'])]
    public function dashboard(PatientRepository $patientRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Aucun utilisateur connecté.');
        }

        $patient = $patientRepository->findByPersonneLogin($user->getUserIdentifier());

        if (!$patient) {
            throw $this->createNotFoundException('Patient non trouvé.');
        }
        $visites = $patient->getVisites();

        return $this->render('patient/dashboard.html.twig', [
            'patient' => $patient,
            'visites' => $visites,
        ]);
    }

    #[Route('/mon-compte', name: 'app_patient_mon_compte', methods: ['GET', 'POST'])]
    public function monCompte(Request $request, EntityManagerInterface $entityManager, PatientRepository $patientRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté.');
        }

        $patient = $patientRepository->findByPersonneLogin($user->getUserIdentifier());

        if (!$patient) {
            throw $this->createNotFoundException('Patient non trouvé.');
        }

        $form = $this->createForm(PatientType::class, $patient, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Vos informations ont été mises à jour.');
            return $this->redirectToRoute('app_patient_mon_compte');
        }

        return $this->render('patient/mon_compte.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
        ]);
    }
}
