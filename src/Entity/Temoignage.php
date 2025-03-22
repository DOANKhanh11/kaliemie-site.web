<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'temoignage')]
#[ORM\Index(name: 'personne_login', columns: ['personne_login'])]
class Temoignage
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $id;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $personneLogin;

    #[ORM\Column(type: 'text', length: 16777215, nullable: false)]
    private string $contenu;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $valide;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonneLogin(): ?int
    {
        return $this->personneLogin;
    }

    public function setPersonneLogin(int $personneLogin): self
    {
        $this->personneLogin = $personneLogin;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }
}
