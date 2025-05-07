<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\PersonneLogin;

#[ORM\Entity]
#[ORM\Table(name: 'infirmiere')]
class Infirmiere
{
    #[ORM\Id]
    #[ORM\OneToOne(inversedBy: 'infirmiere', targetEntity: PersonneLogin::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', nullable: false)]
    private ?PersonneLogin $personneLogin = null;

    #[ORM\OneToOne(targetEntity: Personne::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id')]
    private ?Personne $idPersonne = null;

    #[ORM\Column(type: 'string', length: 250, nullable: true)]
    private ?string $fichierPhoto = null;

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

    public function getPersonne(): ?PersonneLogin
    {
        return $this->personneLogin;
    }

    public function set(?PersonneLogin $personneLogin): self
    {
        $this->personneLogin = $personneLogin;
        return $this;
    }

    public function getIdPersonne(): ?Personne
    {
        return $this->idPersonne;
    }

    public function setIdPersonne(?Personne $id): self
    {
        $this->idPersonne = $id;

        return $this;
    }

    public function getFichierPhoto(): ?string
    {
        return $this->fichierPhoto;
    }

    public function setFichierPhoto(?string $fichierPhoto): self
    {
        $this->fichierPhoto = $fichierPhoto;
        return $this;
    }
}
