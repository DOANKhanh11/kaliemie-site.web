<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'chambre_forte')]
class ChambreForte
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 25)]
    private string $badge;

    #[ORM\Id]
    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'boolean')]
    private bool $accesOk;

    public function getBadge(): string
    {
        return $this->badge;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getAccesOk(): bool
    {
        return $this->accesOk;
    }

    public function setAccesOk(bool $accesOk): self
    {
        $this->accesOk = $accesOk;

        return $this;
    }
}
