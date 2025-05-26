<?php

namespace App\Security;

use App\Repository\PersonneLoginRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';


    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private UserPasswordHasherInterface $passwordHasher,
        private PersonneLoginRepository $personneLoginRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function authenticate(Request $request): Passport
    {
        $login = $request->get('login');
        $password = $request->get('password');
        
        
        if (!$login || !$password) {
            throw new \InvalidArgumentException("Login et mot de passe requis.");
        }
    
        $user = $this->personneLoginRepository->findByLogin($login);

        if (!$user) {
            throw new AuthenticationException('Utilisateur non trouvé.');
        }

        if (md5($password) !== $user->getMp()) {
            throw new AuthenticationException('Mot de passe incorrect.');
        }
        
        return new Passport(
            new UserBadge($login, fn() => $user),
            new CustomCredentials(
                function ($credentials, UserInterface $user) use ($password) {
                    // kiểm tra lại trong callback nếu muốn
                    return true; // xác thực thành công
                },
                $password // credentials sẽ truyền qua callback nếu cần
            ),
            [
                new CsrfTokenBadge('authenticate', $request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }
    

    private function getUserByLogin(string $login): ?UserInterface
    {
        return $this->personneLoginRepository->findByLogin($login);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        /*if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }*/

        $user = $token->getUser();

         if ($user instanceof \App\Entity\PersonneLogin) {
            $user->setDerniereConnexion(new \DateTime());
            $this->entityManager->flush(); 
        }

        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return new RedirectResponse($this->urlGenerator->generate('admin_dashboard'));
        }

        if (in_array('ROLE_INFIRMIERE', $user->getRoles(), true)) {
            return new RedirectResponse($this->urlGenerator->generate('infirmiere_dashboard'));
        }

        if (in_array('ROLE_PATIENT', $user->getRoles(), true)) {
            return new RedirectResponse($this->urlGenerator->generate('patient_dashboard'));
        }

        
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
        }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
