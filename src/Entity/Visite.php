<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'visite')]
class Visite
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Patient::class)]
    #[ORM\JoinColumn(name: 'patient', referencedColumnName: 'id', nullable: false)]
    private Patient $patient;

    #[ORM\ManyToOne(targetEntity: Infirmiere::class)]
    #[ORM\JoinColumn(name: 'infirmiere', referencedColumnName: 'id', nullable: false)]
    private Infirmiere $infirmiere;

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

    #[ORM\OneToMany(mappedBy: 'visite', targetEntity: SoinsVisite::class)]
    private $soinsVisite;

    public function __construct()
    {
        $this->soinsVisite = new ArrayCollection();
    }

    public function getSoinsVisite(): Collection
    {
        return $this->soinsVisite;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): self
    {
        $this->patient = $patient;
        return $this;
    }

    public function getInfirmiere(): ?Infirmiere
    {
        return $this->infirmiere;
    }

    public function setInfirmiere(Infirmiere $infirmiere): self
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

    public function addSoinsVisite(SoinsVisite $soinsVisite): static
    {
        if (!$this->soinsVisite->contains($soinsVisite)) {
            $this->soinsVisite->add($soinsVisite);
            $soinsVisite->setVisite($this);
        }

        return $this;
    }

    public function removeSoinsVisite(SoinsVisite $soinsVisite): static
    {
        if ($this->soinsVisite->removeElement($soinsVisite)) {
            // set the owning side to null (unless already changed)
            if ($soinsVisite->getVisite() === $this) {
                $soinsVisite->setVisite(null);
            }
        }

        return $this;
    }
    public function estRealisee(): bool
    {
        return $this->dateReelle !== null || $this->datePrevue < new \DateTime();
    }
}
