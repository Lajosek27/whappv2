<?php

namespace App\Entity;

use App\Repository\PointsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointsRepository::class)]
class Points
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $fate = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $luck = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $resolve = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $resilience = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $speed = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $walk = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $run = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFate(): ?int
    {
        return $this->fate;
    }

    public function setFate(int $fate): self
    {
        $this->fate = $fate;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(int $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getResolve(): ?int
    {
        return $this->resolve;
    }

    public function setResolve(int $resolve): self
    {
        $this->resolve = $resolve;

        return $this;
    }

    public function getResilience(): ?int
    {
        return $this->resilience;
    }

    public function setResilience(int $resilience): self
    {
        $this->resilience = $resilience;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getWalk(): ?int
    {
        return $this->walk;
    }

    public function setWalk(int $walk): self
    {
        $this->walk = $walk;

        return $this;
    }

    public function getRun(): ?int
    {
        return $this->run;
    }

    public function setRun(int $run): self
    {
        $this->run = $run;

        return $this;
    }
}
