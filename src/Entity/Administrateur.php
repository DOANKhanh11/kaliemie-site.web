<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\PersonneLogin;

#[ORM\Entity]
#[ORM\Table(name: 'administrateur')]
class Administrateur
{
    #[ORM\Id]
    #[ORM\OneToOne(inversedBy: 'administrateur', targetEntity: PersonneLogin::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id')]
    private ?PersonneLogin $personneLogin = null;

    public function getId(): ?int
    {
        return $this->personneLogin?->getId();
    }

    public function getPersonneLogin(): ?PersonneLogin
    {
        return $this->personneLogin;
    }

    public function setPersonneLogin(?PersonneLogin $personneLogin): self
    {
        $this->personneLogin = $personneLogin;
        return $this;
    }
}
