<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\PersonneLoginRepository;

#[ORM\Entity(repositoryClass: PersonneLoginRepository::class)]
#[ORM\Table(name: 'personne_login')]
class PersonneLogin implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 25, unique: true)]
    private string $login;

    #[ORM\Column(type: 'string', length: 64)]
    private string $mp;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $derniereConnexion;

    #[ORM\OneToOne(mappedBy: 'personneLogin', targetEntity: Infirmiere::class)]
    private ?Infirmiere $infirmiere = null;

    #[ORM\OneToOne(mappedBy: 'personneLogin', targetEntity: Administrateur::class)]
    private ?Administrateur $administrateur = null;

    #[ORM\OneToOne(mappedBy: 'personneLogin', targetEntity: Patient::class)]
    private ?Patient $patient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    //public function getUserIdentifier(): string
    public function getLogin(): string
    {
        return $this->login;
    }

    public function getUserIdentifier(): string
    //public function getLogin(): string
    {
        return $this->login;
    }

    //public function setUserIdentifier(string $login): self
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function setUserIdentifier(string $login): self
    //public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->mp;
    }

    public function getMp(): string
    {
        return $this->mp;
    }

    public function setMp(string $mp): self
    {
        $this->mp = $mp;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = [];
    
        if ($this->administrateur !== null) {
            $roles[] = 'ROLE_ADMIN';
        } elseif ($this->infirmiere !== null) {
            $roles[] = 'ROLE_INFIRMIERE';
        } elseif ($this->patient !== null){
            $roles[] = 'ROLE_PATIENT';
        }
    
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }    

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        
    }

    public function getDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->derniereConnexion;
    }

    public function setDerniereConnexion(?\DateTimeInterface $derniereConnexion): static
    {
        $this->derniereConnexion = $derniereConnexion;

        return $this;
    }

    public function getInfirmiere(): ?Infirmiere
    {
        return $this->infirmiere;
    }

    public function setInfirmiere(?Infirmiere $infirmiere): static
    {
        // unset the owning side of the relation if necessary
        if ($infirmiere === null && $this->infirmiere !== null) {
            $this->infirmiere->setPersonneLogin(null);
        }

        // set the owning side of the relation if necessary
        if ($infirmiere !== null && $infirmiere->getPersonneLogin() !== $this) {
            $infirmiere->setPersonneLogin($this);
        }

        $this->infirmiere = $infirmiere;

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?Administrateur $administrateur): static
    {
        // unset the owning side of the relation if necessary
        if ($administrateur === null && $this->administrateur !== null) {
            $this->administrateur->setPersonneLogin(null);
        }

        // set the owning side of the relation if necessary
        if ($administrateur !== null && $administrateur->getPersonneLogin() !== $this) {
            $administrateur->setPersonneLogin($this);
        }

        $this->administrateur = $administrateur;

        return $this;
    }
    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        if ($patient === null && $this->patient !== null) {
            $this->patient->setPersonneLogin(null);
        }

        if ($patient !== null && $patient->getPersonneLogin() !== $this) {
            $patient->setPersonneLogin($this);
        }

        $this->patient = $patient;

        return $this;
    }
}