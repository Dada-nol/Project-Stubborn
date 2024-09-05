<?php

namespace App\Entity;

use App\Repository\TailleSweatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TailleSweatRepository::class)]
class TailleSweat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $size = null;

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize($size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
