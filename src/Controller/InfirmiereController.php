<?php

// src/Controller/InfirmiereController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

final class InfirmiereController extends AbstractController
{
    #[Route('/infirmiere/login', name: 'infirmiere_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Trả về các thông tin để hiển thị trong form login
        return $this->render('infirmiere/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/infirmiere/logout', name: 'infirmiere_logout')]
    public function logout(): void
    {
        // Đây là method giả, không bao giờ được gọi.
        throw new \Exception('This should never be reached!');
    }

    #[Route('/infirmiere/dashboard', name: 'infirmiere_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('infirmiere/dashboard.html.twig');
    }
}
