<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SweatShirts $SweatShirt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TailleSweat $size = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getquantity(): ?int
    {
        return $this->quantity;
    }

    public function setquantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSweatShirt(): ?SweatShirts
    {
        return $this->SweatShirt;
    }

    public function setSweatShirt(?SweatShirts $SweatShirt): static
    {
        $this->SweatShirt = $SweatShirt;

        return $this;
    }

    public function getSize(): ?TailleSweat
    {
        return $this->size;
    }

    public function setSize(?TailleSweat $size): static
    {
        $this->size = $size;

        return $this;
    }
}
