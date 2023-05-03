<?php

namespace App\Entity;

use App\Repository\AttributesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributesRepository::class)]
class Attributes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $maleWepons = null;

    #[ORM\Column]
    private ?int $rangeWepons = null;

    #[ORM\Column]
    private ?int $strenght = null;

    #[ORM\Column]
    private ?int $resistance = null;

    #[ORM\Column]
    private ?int $initiative = null;

    #[ORM\Column]
    private ?int $agility = null;

    #[ORM\Column]
    private ?int $dexterity = null;

    #[ORM\Column]
    private ?int $intelligency = null;

    #[ORM\Column]
    private ?int $will = null;

    #[ORM\Column]
    private ?int $charisma = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaleWepons(): ?int
    {
        return $this->maleWepons;
    }

    public function setMaleWepons(int $maleWepons): self
    {
        $this->maleWepons = $maleWepons;

        return $this;
    }

    public function getRangeWepons(): ?int
    {
        return $this->rangeWepons;
    }

    public function setRangeWepons(int $rangeWepons): self
    {
        $this->rangeWepons = $rangeWepons;

        return $this;
    }

    public function getStrenght(): ?int
    {
        return $this->strenght;
    }

    public function setStrenght(int $strenght): self
    {
        $this->strenght = $strenght;

        return $this;
    }

    public function getResistance(): ?int
    {
        return $this->resistance;
    }

    public function setResistance(int $resistance): self
    {
        $this->resistance = $resistance;

        return $this;
    }

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(int $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getAgility(): ?int
    {
        return $this->agility;
    }

    public function setAgility(int $agility): self
    {
        $this->agility = $agility;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getIntelligency(): ?int
    {
        return $this->intelligency;
    }

    public function setIntelligency(int $intelligency): self
    {
        $this->intelligency = $intelligency;

        return $this;
    }

    public function getWill(): ?int
    {
        return $this->will;
    }

    public function setWill(int $will): self
    {
        $this->will = $will;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(int $charisma): self
    {
        $this->charisma = $charisma;

        return $this;
    }
}
