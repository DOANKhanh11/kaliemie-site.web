<?php
namespace App\Controller;

use App\Entity\Infirmiere;
use App\Entity\Patient;
use App\Entity\Visite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $totalPatients = $this->entityManager->getRepository(Patient::class)->count([]);
        $totalNurses = $this->entityManager->getRepository(Infirmiere::class)->count([]);
        $totalVisits = $this->entityManager->getRepository(Visite::class)->count([]);

        return $this->render('home/index.html.twig', [
            'total_patients' => $totalPatients,
            'total_nurses' => $totalNurses,
            'total_visits' => $totalVisits,
        ]);
    }

    #[Route('/team', name: 'app_team')]
    public function team(): Response
    {
        $nurses = $this->entityManager->getRepository(Infirmiere::class)->findAll();

        return $this->render('home/team.html.twig', [
            'nurses' => $nurses,
        ]);
    }

    #[Route('/patients', name: 'app_patients')]
    public function patients(): Response
    {
        $patients = $this->entityManager->getRepository(Patient::class)->findAll();

        return $this->render('home/patients.html.twig', [
            'patients' => $patients,
        ]);
    }

    #[Route('/visits', name: 'app_visits')]
    public function visits(): Response
    {
        $visits = $this->entityManager->getRepository(Visite::class)->findAll();

        return $this->render('home/visits.html.twig', [
            'visits' => $visits,
        ]);
    }
}
