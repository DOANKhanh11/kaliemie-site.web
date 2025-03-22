<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'convalescence')]
#[ORM\Index(name: 'id_lieux', columns: ['id_lieux'])]
class Convalescence
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private int $idPatient;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private int $idLieux;

    #[ORM\Id]
    #[ORM\Column(type: 'date')]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private \DateTimeInterface $dateDeb;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $dateFin;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $chambre;

    #[ORM\Column(type: 'string', length: 10, nullable: true, options: ['fixed' => true])]
    private ?string $telDirecte;

    public function getIdPatient(): int
    {
        return $this->idPatient;
    }

    public function getIdLieux(): int
    {
        return $this->idLieux;
    }

    public function getDateDeb(): \DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    public function getChambre(): ?string
    {
        return $this->chambre;
    }

    public function setChambre(?string $chambre): self
    {
        $this->chambre = $chambre;
        return $this;
    }

    public function getTelDirecte(): ?string
    {
        return $this->telDirecte;
    }

    public function setTelDirecte(?string $telDirecte): self
    {
        $this->telDirecte = $telDirecte;
        return $this;
    }
}
