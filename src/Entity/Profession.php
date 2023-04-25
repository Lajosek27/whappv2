<?php

namespace App\Entity;

use App\Repository\ProfessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionRepository::class)]
class Profession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private array $tierNames = [];

    #[ORM\Column]
    private array $statuses = [];

    #[ORM\Column(length: 30)]
    private ?string $grupe = null;

    #[ORM\Column(length: 180)]
    private ?string $creatorName = null;

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

    public function getTierNames(): array
    {
        return $this->tierNames;
    }

    public function setTierNames(array $tierNames): self
    {
        $this->tierNames = $tierNames;

        return $this;
    }

    public function getStatuses(): array
    {
        return $this->statuses;
    }

    public function setStatuses(array $statuses): self
    {
        $this->statuses = $statuses;

        return $this;
    }


    public function getTier(int $tier = 0) : array|false
    {   
        if( 0 > $tier || $tier > 3){return false;}

        return array(
            'name' => $this->getTierNames()[$tier],
            'status' => $this->getStatuses()[$tier]
        );
    }

    public function getGrupe(): ?string
    {
        return $this->grupe;
    }

    public function setGrupe(string $grupe): self
    {
        $this->grupe = $grupe;

        return $this;
    }

    public function getCreatorName(): ?string
    {
        return $this->creatorName;
    }

    public function setCreatorName(string $creatorName): self
    {
        $this->creatorName = $creatorName;

        return $this;
    }
}
