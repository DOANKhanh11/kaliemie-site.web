<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'patient')]
#[ORM\Index(name: 'personne_de_confiance', columns: ['personne_de_confiance'])]
#[ORM\Index(name: 'infirmiere_souhait', columns: ['infirmiere_souhait'])]
class Patient
{
    #[ORM\Column(type: 'text', length: 65535, nullable: false)]
    private string $informationsMedicales = '';

    #[ORM\Id]
    #[ORM\OneToOne(inversedBy: 'patient', targetEntity: PersonneLogin::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', nullable: false)]
    private ?PersonneLogin $personneLogin = null;

    
    #[ORM\OneToOne(targetEntity: Personne::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id')]
    private ?Personne $idPersonne = null;

    #[ORM\ManyToOne(targetEntity: Personne::class)]
    #[ORM\JoinColumn(name: 'personne_de_confiance', referencedColumnName: 'id')]
    private ?Personne $personneDeConfiance;

    #[ORM\ManyToOne(targetEntity: Infirmiere::class)]
    #[ORM\JoinColumn(name: 'infirmiere_souhait', referencedColumnName: 'id')]
    private ?Infirmiere $infirmiereSouhait;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Visite::class)]
    private Collection $visites;

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

    public function getInformationsMedicales(): ?string
    {
        return $this->informationsMedicales;
    }

    public function setInformationsMedicales(string $informationsMedicales): self
    {
        $this->informationsMedicales = $informationsMedicales;

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

    public function getPersonneDeConfiance(): ?Personne
    {
        return $this->personneDeConfiance;
    }

    public function setPersonneDeConfiance(?Personne $personneDeConfiance): self
    {
        $this->personneDeConfiance = $personneDeConfiance;

        return $this;
    }

    public function getInfirmiereSouhait(): ?Infirmiere
    {
        return $this->infirmiereSouhait;
    }

    public function setInfirmiereSouhait(?Infirmiere $infirmiereSouhait): self
    {
        $this->infirmiereSouhait = $infirmiereSouhait;

        return $this;
    }
    public function __construct()
    {
        $this->visites = new ArrayCollection();
    }

    public function getVisites(): Collection
    {
        return $this->visites;
    }
}
