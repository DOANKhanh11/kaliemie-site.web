<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'infirmiere')]
class Infirmiere
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\Column(type: 'string', length: 250, nullable: true)]
    private ?string $fichierPhoto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichierPhoto(): ?string
    {
        return $this->fichierPhoto;
    }

    public function setFichierPhoto(?string $fichierPhoto): self
    {
        $this->fichierPhoto = $fichierPhoto;

        return $this;
    }
}
