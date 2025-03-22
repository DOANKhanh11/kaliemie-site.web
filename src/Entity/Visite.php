<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'visite')]
#[ORM\Index(name: 'patient', columns: ['patient'])]
#[ORM\Index(name: 'infirmiere', columns: ['infirmiere'])]
class Visite
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $id;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $patient;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $infirmiere;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTimeInterface $datePrevue;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $dateReelle;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $duree;

    #[ORM\Column(type: 'text', length: 65535, nullable: true)]
    private ?string $compteRenduInfirmiere;

    #[ORM\Column(type: 'text', length: 65535, nullable: true)]
    private ?string $compteRenduPatient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?int
    {
        return $this->patient;
    }

    public function setPatient(int $patient): self
    {
        $this->patient = $patient;
        return $this;
    }

    public function getInfirmiere(): ?int
    {
        return $this->infirmiere;
    }

    public function setInfirmiere(int $infirmiere): self
    {
        $this->infirmiere = $infirmiere;
        return $this;
    }

    public function getDatePrevue(): ?\DateTimeInterface
    {
        return $this->datePrevue;
    }

    public function setDatePrevue(\DateTimeInterface $datePrevue): self
    {
        $this->datePrevue = $datePrevue;
        return $this;
    }

    public function getDateReelle(): ?\DateTimeInterface
    {
        return $this->dateReelle;
    }

    public function setDateReelle(?\DateTimeInterface $dateReelle): self
    {
        $this->dateReelle = $dateReelle;
        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;
        return $this;
    }

    public function getCompteRenduInfirmiere(): ?string
    {
        return $this->compteRenduInfirmiere;
    }

    public function setCompteRenduInfirmiere(?string $compteRenduInfirmiere): self
    {
        $this->compteRenduInfirmiere = $compteRenduInfirmiere;
        return $this;
    }

    public function getCompteRenduPatient(): ?string
    {
        return $this->compteRenduPatient;
    }

    public function setCompteRenduPatient(?string $compteRenduPatient): self
    {
        $this->compteRenduPatient = $compteRenduPatient;
        return $this;
    }
}
