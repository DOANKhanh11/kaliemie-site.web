<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'soins')]
#[ORM\Index(name: 'id_categ_soins', columns: ['id_categ_soins'])]
#[ORM\Index(name: 'id_type_soins', columns: ['id_type_soins'])]
class Soins
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idCategSoins;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idTypeSoins;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $id;

    #[ORM\Column(type: 'text', length: 65535, nullable: false)]
    private string $libel;

    #[ORM\Column(type: 'text', length: 65535, nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'float', precision: 10, scale: 0, nullable: false)]
    private float $coefficient;

    // Sửa lại phần khai báo $date
    #[ORM\Column(type: 'datetime', nullable: false)]
    private ?\DateTimeInterface $date = null;  // Không sử dụng chuỗi 'CURRENT_TIMESTAMP'

    public function __construct()
    {
        // Gán giá trị mặc định cho $date trong constructor
        $this->date = new \DateTime();  // Gán ngày giờ hiện tại cho date
    }

    public function getIdCategSoins(): ?int
    {
        return $this->idCategSoins;
    }

    public function getIdTypeSoins(): ?int
    {
        return $this->idTypeSoins;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(float $coefficient): self
    {
        $this->coefficient = $coefficient;

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
}
