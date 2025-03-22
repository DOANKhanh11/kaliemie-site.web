<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'type_soins')]
#[ORM\Index(name: 'id_categ_soins', columns: ['id_categ_soins'])]
#[ORM\Index(name: 'id_type_soins', columns: ['id_type_soins'])]
class TypeSoins
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idCategSoins;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idTypeSoins;

    #[ORM\Column(type: 'text', length: 65535, nullable: false)]
    private string $libel;

    #[ORM\Column(type: 'text', length: 65535, nullable: true)]
    private ?string $description;

    public function getIdCategSoins(): ?int
    {
        return $this->idCategSoins;
    }

    public function getIdTypeSoins(): ?int
    {
        return $this->idTypeSoins;
    }

    public function getLibel(): ?string
    {
        return $this->libel;
    }

    public function setLibel(string $libel): self
    {
        $this->libel = $libel;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
