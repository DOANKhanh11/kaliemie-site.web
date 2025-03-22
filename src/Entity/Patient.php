<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'patient')]
#[ORM\Index(name: 'personne_de_confiance', columns: ['personne_de_confiance'])]
#[ORM\Index(name: 'infirmiere_souhait', columns: ['infirmiere_souhait'])]
class Patient
{
    #[ORM\Column(type: 'text', length: 65535, nullable: false)]
    private string $informationsMedicales;

    #[ORM\Id]
    #[ORM\OneToOne(targetEntity: Personne::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id')]
    private Personne $id;

    #[ORM\ManyToOne(targetEntity: Personne::class)]
    #[ORM\JoinColumn(name: 'personne_de_confiance', referencedColumnName: 'id')]
    private ?Personne $personneDeConfiance;

    #[ORM\ManyToOne(targetEntity: Infirmiere::class)]
    #[ORM\JoinColumn(name: 'infirmiere_souhait', referencedColumnName: 'id')]
    private ?Infirmiere $infirmiereSouhait;

    public function getInformationsMedicales(): ?string
    {
        return $this->informationsMedicales;
    }

    public function setInformationsMedicales(string $informationsMedicales): self
    {
        $this->informationsMedicales = $informationsMedicales;

        return $this;
    }

    public function getId(): ?Personne
    {
        return $this->id;
    }

    public function setId(?Personne $id): self
    {
        $this->id = $id;

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
}
