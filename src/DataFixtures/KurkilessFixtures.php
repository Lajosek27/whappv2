<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Points;
use App\Entity\Character;
use App\Entity\CharacterInfo;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class KurkilessFixtures extends Fixture implements DependentFixtureInterface
{   
    private $passwordHasher;



    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {   
        
        $user = new User();
        $user->setUsername('kurkilles');  
        $user->setRoles(array('USER'));  
        $hashedPassword = $this->passwordHasher->hashPassword($user ,'kurkilles');
        $user->setPassword($hashedPassword);
        
        $manager->persist($user);
        
        
        $character= new Character();
        $character->setName('Hans');
        $character->setIsPrivate(false);
        $character->setPlayer($user);
        $character->setGameMaster(
            $this->getReference(AdminFixtures::ADMIN)
        );
        $character->setProfessionLv(0);
        $character->setProfession($this->getReference(ProfessionFixtures::PROF_FLAX));


        $info = new CharacterInfo();
        $info->setRace('Człowiek');
        $info->setHeight(180);
        $info->setHair('Jasny brąz, broda');
        $info->setEyes('Szare');
        $info->setAge(23);
        $character->setInfo($info);

        $points = new Points();
        $points->setFate(3);
        $points->setResolve(3);
        $points->setResilience(2);
        $points->setLuck(3);
        $points->setSpeed(4);
        $points->setWalk(8);
        $points->setRun(16);
        $character->setPoints($points);

        $manager->persist($character);
        
        $character1= new Character();
        $character1->setName('Hans GM');
        $character1->setIsPrivate(true);
        $character1->setPlayer($this->getReference(AdminFixtures::ADMIN));
        $character1->setGameMaster(
            $user
        );
        $character1->setProfessionLv(2);
        $character1->setProfession($this->getReference(ProfessionFixtures::PROF_FLAX));


        $info1 = new CharacterInfo();
        $info1->setRace('Człowiek');
        $info1->setHeight(178);
        $info1->setHair('Brak');
        $info1->setEyes('Ciemnoniebieskie');
        $info1->setAge(28);
        $character1->setInfo($info1);

        $points1 = new Points();
        $points1->setFate(3);
        $points1->setResolve(3);
        $points1->setResilience(2);
        $points1->setLuck(3);
        $points1->setSpeed(4);
        $points1->setWalk(8);
        $points1->setRun(16);
        $character1->setPoints($points1);

        $manager->persist($character1);

        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProfessionFixtures::class,
        ];
    }
}
