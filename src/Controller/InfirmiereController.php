<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InfirmiereController extends AbstractController
{
    #[Route('/infirmiere/login', name: 'infirmiere_login')]
    public function login(): Response
    {
        return $this->render('infirmiere/login.html.twig');
    }

    #[Route('/infirmiere/dashboard', name: 'infirmiere_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('infirmiere/dashboard.html.twig');
    }
}

