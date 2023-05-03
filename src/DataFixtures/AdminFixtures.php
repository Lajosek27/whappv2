<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Character;
use App\Entity\CharacterInfo;
use App\Entity\Points;
use App\Entity\Exp;
use App\Entity\Attributes;
use App\Entity\DevelopmentsAttributes;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class AdminFixtures extends Fixture implements DependentFixtureInterface
{   
    private $passwordHasher;
    public const ADMIN = 'USER-ADMIN';

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {   
        
        $admin = new User();
        $admin->setUsername('admin');  
        $admin->setRoles(array('ADMIN','USER'));  
        $hashedPassword = $this->passwordHasher->hashPassword($admin ,'admin');
        $admin->setPassword($hashedPassword);
        
        $manager->persist($admin);
        $this->addReference(self::ADMIN, $admin);
        
        $user = new User();
        $user->setUsername('Lajosek');  
        $user->setRoles(array('USER'));  
        $hashedPassword = $this->passwordHasher->hashPassword($user ,'admin');
        $user->setPassword($hashedPassword);
        
        $manager->persist($user);
        
        
        $character= new Character();
        $character->setName('Ruben');
        $character->setIsPrivate(false);
        $character->setPlayer(
            $admin
        );
        $character->setProfessionLv(0);
        $character->setProfession($this->getReference(ProfessionFixtures::PROF_WITH_HUNTER));

        
        $info = new CharacterInfo();
        $info->setRace('Człowiek');
        $info->setHeight(185);
        $info->setHair('Krótkie Czarne');
        $info->setEyes('Zielone');
        $info->setAge(33);
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
        

        $exp = new Exp();
        $exp->setFree(500);
        $exp->setSpend(500);
        $character->setExp($exp);

        $attr = new Attributes();
        $attr->setMaleWepons(33);
        $attr->setRangeWepons(33);
        $attr->setStrenght(33);
        $attr->setResistance(33);
        $attr->setInitiative(33);
        $attr->setAgility(33);
        $attr->setDexterity(33);
        $attr->setIntelligency(33);
        $attr->setWill(33);
        $attr->setCharisma(33);
        $character->setAttributes($attr);


        $attrDev = new DevelopmentsAttributes();
        $attrDev->setMaleWepons(2);
        $attrDev->setRangeWepons(2);
        $attrDev->setStrenght(2);
        $attrDev->setResistance(2);
        $attrDev->setInitiative(2);
        $attrDev->setAgility(2);
        $attrDev->setDexterity(2);
        $attrDev->setIntelligency(2);
        $attrDev->setWill(2);
        $attrDev->setCharisma(2);
        $character->setDevelopmentsAttributes($attrDev);


        $character1= new Character();
        $character1->setName('Nebur');
        $character1->setIsPrivate(false);
        $character1->setPlayer(
            $user
        );
        $character1->setProfessionLv(2);
        $character1->setProfession($this->getReference(ProfessionFixtures::PROF_WITH_HUNTER));
        $character1->setGameMaster($admin);
        
        $info1 = new CharacterInfo();
        $info1->setRace('Człowiek');
        $info1->setHeight(185);
        $info1->setHair('Krótkie Czarne');
        $info1->setEyes('Zielone');
        $info1->setAge(33);
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
        
        $exp1 = new Exp();
        $exp1->setFree(500);
        $exp1->setSpend(500);
        $character1->setExp($exp1);

        
        $attr1 = new Attributes();
        $attr1->setMaleWepons(33);
        $attr1->setRangeWepons(33);
        $attr1->setStrenght(33);
        $attr1->setResistance(33);
        $attr1->setInitiative(33);
        $attr1->setAgility(33);
        $attr1->setDexterity(33);
        $attr1->setIntelligency(33);
        $attr1->setWill(33);
        $attr1->setCharisma(33);
        $character1->setAttributes($attr1);


        $attrDev1 = new DevelopmentsAttributes();
        $attrDev1->setMaleWepons(2);
        $attrDev1->setRangeWepons(2);
        $attrDev1->setStrenght(2);
        $attrDev1->setResistance(2);
        $attrDev1->setInitiative(2);
        $attrDev1->setAgility(2);
        $attrDev1->setDexterity(2);
        $attrDev1->setIntelligency(2);
        $attrDev1->setWill(2);
        $attrDev1->setCharisma(2);
        $character1->setDevelopmentsAttributes($attrDev1);

        $manager->persist($character);
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
