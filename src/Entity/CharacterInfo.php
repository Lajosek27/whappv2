<?php

namespace App\Entity;

use App\Repository\CharacterInfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterInfoRepository::class)]
class CharacterInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $race = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(nullable: true)]
    private ?int $height = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $hair = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $eyes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getHair(): ?string
    {
        return $this->hair;
    }

    public function setHair(?string $hair): self
    {
        $this->hair = $hair;

        return $this;
    }

    public function getEyes(): ?string
    {
        return $this->eyes;
    }

    public function setEyes(?string $eyes): self
    {
        $this->eyes = $eyes;

        return $this;
    }
}
