<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'personne')]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $id;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    private string $nom;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    private string $prenom;

    #[ORM\Column(type: 'string', length: 1, nullable: false, options: ['fixed' => true])]
    private string $sexe;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $dateNaiss;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $dateDeces;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $ad1;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $ad2;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $cp;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $ville;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private ?string $telFixe;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private ?string $telPort;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private ?string $mail;

    public function __toString(): string
{
    return $this->prenom . ' ' . $this->nom;
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;
        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;
        return $this;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;
        return $this;
    }

    public function getAd1(): ?string
    {
        return $this->ad1;
    }

    public function setAd1(?string $ad1): self
    {
        $this->ad1 = $ad1;
        return $this;
    }

    public function getAd2(): ?string
    {
        return $this->ad2;
    }

    public function setAd2(?string $ad2): self
    {
        $this->ad2 = $ad2;
        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(?int $cp): self
    {
        $this->cp = $cp;
        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;
        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->telFixe;
    }

    public function setTelFixe(?string $telFixe): self
    {
        $this->telFixe = $telFixe;
        return $this;
    }

    public function getTelPort(): ?string
    {
        return $this->telPort;
    }

    public function setTelPort(?string $telPort): self
    {
        $this->telPort = $telPort;
        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }
}
