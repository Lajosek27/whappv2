<?php

namespace App\Entity;

use App\Repository\ExpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpRepository::class)]
class Exp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   
    #[ORM\Column]
    private ?int $spend = null;

    #[ORM\Column]
    private ?int $free = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpend(): ?int
    {
        return $this->spend;
    }

    public function setSpend(int $spend): self
    {
        $this->spend = $spend;

        return $this;
    }

    public function getFree(): ?int
    {
        return $this->free;
    }

    public function setFree(int $free): self
    {
        $this->free = $free;

        return $this;
    }
}
