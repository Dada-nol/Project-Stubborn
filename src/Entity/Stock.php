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
    private ?SweatShirts $SweatShirt_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sizes $Size_id = null;

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
        return $this->SweatShirt_id;
    }

    public function setSweatShirtId(?SweatShirts $SweatShirt_id): static
    {
        $this->SweatShirt_id = $SweatShirt_id;

        return $this;
    }

    public function getSizeId(): ?Sizes
    {
        return $this->Size_id;
    }

    public function setSizeId(?Sizes $Size_id): static
    {
        $this->Size_id = $Size_id;

        return $this;
    }
}
