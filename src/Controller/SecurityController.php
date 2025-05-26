<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\PersonneLoginRepository;
use Symfony\Bundle\SecurityBundle\Security;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class SecurityController extends AbstractController
{
    private PersonneLoginRepository $personneLoginRepository;

    public function __construct(PersonneLoginRepository $personneLoginRepository)
    {
        $this->personneLoginRepository = $personneLoginRepository;
    }

    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        $user = $this->personneLoginRepository->findByLogin('glagaffe');
        dd($user);

        return new Response('OK');
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        error_log('Logout method called');
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/redirect-after-login', name: 'redirect_after_login')]
    public function redirectAfterLogin(Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $roles = $user->getRoles();

        if (in_array('ROLE_ADMIN', $roles)) {
            return $this->redirectToRoute('admin_dashboard');
        }
        if (in_array('ROLE_INFIRMIERE', $roles)) {
            return $this->redirectToRoute('infirmiere_dashboard');
        }
        if (in_array('ROLE_PATIENT', $roles)) {
            return $this->redirectToRoute('patient_dashboard');
        }

    return $this->redirectToRoute('app_login');
}

#[Route('/change-password', name: 'app_change_password')]
    public function changePassword(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $login = $form->get('login')->getData();
            $currentPassword = $form->get('currentPassword')->getData();
            $newPassword = $form->get('newPassword')->getData();

            // Tìm user theo login nhập trong form
            $user = $this->personneLoginRepository->findOneBy(['login' => $login]);

            if (!$user) {
                $this->addFlash('danger', 'Nom d\'utilisateur incorrect.');
            } elseif ($user->getMp() !== md5($currentPassword)) {
                $this->addFlash('danger', 'Mot de passe actuel incorrect.');
            } else {
                $user->setMp(md5($newPassword));
                $em->flush();

                $this->addFlash('success', 'Mot de passe changé avec succès.');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('security/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
