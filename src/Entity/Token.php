<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'token')]
#[ORM\Index(name: 'id_login', columns: ['id_login'])]
class Token
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $id;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idLogin;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'text', length: 65535, nullable: false)]
    private string $jeton;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLogin(): ?int
    {
        return $this->idLogin;
    }

    public function setIdLogin(int $idLogin): self
    {
        $this->idLogin = $idLogin;

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

    public function getJeton(): ?string
    {
        return $this->jeton;
    }

    public function setJeton(string $jeton): self
    {
        $this->jeton = $jeton;

        return $this;
    }
}
