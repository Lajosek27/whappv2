<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $name = null;

    #[ORM\ManyToOne]
    private ?User $gameMaster = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $player = null;

    #[ORM\Column]
    private ?bool $isPrivate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?CharacterInfo $info = null;

    #[ORM\ManyToOne]
    private ?Profession $profession = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $professionLv = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Points $points = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Exp $exp = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Attributes $attributes = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?developmentsAttributes $developmentsAttributes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGameMaster(): ?User
    {
        return $this->gameMaster;
    }

    public function setGameMaster(?User $gameMaster): self
    {
        $this->gameMaster = $gameMaster;

        return $this;
    }

    public function getPlayer(): ?user
    {
        return $this->player;
    }

    public function setPlayer(?user $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function isIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    public function getInfo(): ?CharacterInfo
    {
        return $this->info;
    }

    public function setInfo(CharacterInfo $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getProfession(): ?Profession
    {
        return $this->profession;
    }

    public function setProfession(?Profession $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getProfessionLv(): ?int
    {
        return $this->professionLv;
    }

    public function setProfessionLv(?int $professionLv): self
    {
        $this->professionLv = $professionLv;

        return $this;
    }

    public function getPoints(): ?Points
    {
        return $this->points;
    }

    public function setPoints(?Points $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getExp(): ?Exp
    {
        return $this->exp;
    }

    public function setExp(?Exp $exp): self
    {
        $this->exp = $exp;

        return $this;
    }

    public function getAttributes(): ?Attributes
    {
        return $this->attributes;
    }

    public function setAttributes(?Attributes $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getDevelopmentsAttributes(): ?developmentsAttributes
    {
        return $this->developmentsAttributes;
    }

    public function setDevelopmentsAttributes(developmentsAttributes $developmentsAttributes): self
    {
        $this->developmentsAttributes = $developmentsAttributes;

        return $this;
    }
}
