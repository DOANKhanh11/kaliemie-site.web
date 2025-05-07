<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'indisponibilite')]
#[ORM\Index(name: 'infirmiere', columns: ['infirmiere'])]
#[ORM\Index(name: 'categorie', columns: ['categorie'])]
class Indisponibilite
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private int $infirmiere;

    #[ORM\Column(type: 'date')]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private \DateTimeInterface $dateDebut;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $dateFin;

    #[ORM\Column(type: 'time', nullable: true)]
    private ?\DateTimeInterface $heureDeb;

    #[ORM\Column(type: 'time', nullable: true)]
    private ?\DateTimeInterface $heureFin;

    #[ORM\Column(type: 'integer')]
    private int $categorie;

    public function getInfirmiere(): int
    {
        return $this->infirmiere;
    }

    public function setInfirmiere(int $infirmiere): self
    {
        $this->infirmiere = $infirmiere;
        return $this;
    }

    public function getDateDebut(): \DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        
        return $this;
    }

    public function getDateFin(): \DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getHeureDeb(): ?\DateTimeInterface
    {
        return $this->heureDeb;
    }

    public function setHeureDeb(?\DateTimeInterface $heureDeb): self
    {
        $this->heureDeb = $heureDeb;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(?\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getCategorie(): int
    {
        return $this->categorie;
    }

    public function setCategorie(int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
