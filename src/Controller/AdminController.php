<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PersonneLoginRepository;

class AdminController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function dashboard(PersonneLoginRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $utilisateurs = $repo->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'utilisateurs' => $utilisateurs
        ]);
    }
}
