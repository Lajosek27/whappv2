<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
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
}
