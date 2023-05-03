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

    public function normalize(): array
    {
        return array(
            'race' => $this->race,
            'age' => $this->age,
            'height' => $this->height,
            'hair' => $this->hair,
            'eyes' => $this->eyes,
        );
    }
    public function denormalize($array): self
    {   
        
            $this->race = $array['race'];
    
        if(array_key_exists('age',$array)){
            $this->age = $array['age'];
        }
        if(array_key_exists('height',$array)){
            $this->height = $array['height'];
        }
        if(array_key_exists('hair',$array)){
            $this->hair = $array['hair'];
        }
        if(array_key_exists('eyes',$array)){
            $this->eyes = $array['eyes'];
        }
       

       return $this;
    }
}
