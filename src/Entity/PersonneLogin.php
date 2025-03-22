<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'personne_login')]
class PersonneLogin implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 25, unique: true)]
    private string $login;

    #[ORM\Column(type: 'string', length: 64)]
    private string $mp;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $derniereConnexion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->mp;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        
    }
}