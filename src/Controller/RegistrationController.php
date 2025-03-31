<?php

namespace App\Controller;

use App\Entity\PersonneLogin;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class RegistrationController extends AbstractController
{
    #[Route('/infirmiere/register', name: 'infirmiere_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new PersonneLogin();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        // Check if the form was submitted and is valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Check if the username already exists
            $existingUser = $entityManager->getRepository(PersonneLogin::class)->findOneBy(['login' => $user->getLogin()]);

            if ($existingUser) {
                // Add a flash message to notify the user about the existing username
                $this->addFlash('error', 'Ce nom d\'utilisateur est déjà pris. Veuillez en choisir un autre.');
                
                // Return to the same registration page so the user can change the username
                return $this->redirectToRoute('infirmiere_register');
            }

            // Hash the password before saving
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setMp($hashedPassword);

            // Persist user to the database
            $entityManager->persist($user);
            $entityManager->flush();

            // Add a flash message to notify the user of successful registration
            $this->addFlash('success', 'Votre inscription a été réussie! Vous pouvez maintenant vous connecter.');

            // Redirect to the login page after successful registration
            return $this->redirectToRoute('infirmiere_login');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
