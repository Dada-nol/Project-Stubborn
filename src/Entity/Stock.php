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
    private ?int $quantité = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SweatShirts $SweatShirt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TailleSweat $Size = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(?int $quantité): static
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getSweatShirtId(): ?SweatShirts
    {
        return $this->SweatShirt;
    }

    public function setSweatShirtId(?SweatShirts $SweatShirt): static
    {
        $this->SweatShirt = $SweatShirt;

        return $this;
    }

    public function getSizeId(): ?TailleSweat
    {
        return $this->Size;
    }

    public function setSizeId(?TailleSweat $Size): static
    {
        $this->Size = $Size;

        return $this;
    }
}
