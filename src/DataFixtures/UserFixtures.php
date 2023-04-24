<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Character;
use App\Entity\CharacterInfo;
use App\Entity\Profession;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Json;

class UserFixtures extends Fixture
{
    private $passwordHasher;
    private $entityManager;


    public function __construct(UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }


    public function load(ObjectManager $manager): void
    {
       $admin = new User();
       $admin->setUsername('admin');  
       $admin->setRoles(array('ADMIN','USER'));  
       $hashedPassword = $this->passwordHasher->hashPassword($admin ,'admin');
       $admin->setPassword($hashedPassword);

       $manager->persist($admin);
       


       $user = new User();
       $user->setUsername('mysurek');  
       $user->setRoles(array('USER'));  
       $hashedPassword = $this->passwordHasher->hashPassword($user ,'mysurek');
       $user->setPassword($hashedPassword);

       $manager->persist($user);
       
       $milus = new User();
       $milus->setUsername('milus');  
       $milus->setRoles(array('USER'));  
       $hashedPassword = $this->passwordHasher->hashPassword($user ,'milus');
       $milus->setPassword($hashedPassword);

       $manager->persist($milus);
       
       $manager->flush();

       //characters
       $ruben= new Character();
       $ruben->setName('Ruben');
       $ruben->setIsPrivate(false);
       $ruben->setPlayer(
            $this->entityManager->getRepository(User::class)->findOneBy(['username' => "admin"])
        );
        $infoRuben = new CharacterInfo();
        $infoRuben->setRace('Człowiek');
        $infoRuben->setHeight(185);
        $infoRuben->setHair('Krótkie Czarne');
        $infoRuben->setEyes('Zielone');
        $infoRuben->setAge(33);
        $ruben->setInfo($infoRuben);
        $manager->persist($ruben);
       
        $otto= new Character();
        $otto->setName('Otto');
        $otto->setIsPrivate(false);
        $otto->setPlayer(
                $this->entityManager->getRepository(User::class)->findOneBy(['username' => "mysurek"])
            );
        $otto->setGameMaster(
            $this->entityManager->getRepository(User::class)->findOneBy(['username' => "admin"])
            );
        $infoOtto = new CharacterInfo();
        $infoOtto->setRace('Człowiek');
        $infoOtto->setHeight(178);
        $infoOtto->setHair('Łysy');
        $infoOtto->setEyes('Bursztyn');
        $infoOtto->setAge(45);
        $otto->setInfo($infoOtto);
        $manager->persist($otto);
       
        $kaladin= new Character();
        $kaladin->setName('Kaladin');
        $kaladin->setIsPrivate(false);
        $kaladin->setPlayer(
                $this->entityManager->getRepository(User::class)->findOneBy(['username' => "milus"])
            );
        $infoKal = new CharacterInfo();
        $infoKal->setRace('Człowiek');
        $infoKal->setHeight(181);
        $infoKal->setHair('Czarne długie');
        $infoKal->setEyes('Ciemne');
        $infoKal->setAge(21);
        $kaladin->setInfo($infoKal);
        $manager->persist($kaladin);

    //    $Nebur= new Character();
    //    $Nebur->setName('Nebur');
    //    $Nebur->setIsPrivate(0);
    //    $Nebur->setPlayer(
    //         $this->entityManager->getRepository(User::class)->findOneBy(['username' => "admin"])
    //     );
    //    $manager->persist($Nebur);

    //    $Ast= new Character();
    //    $Ast->setName('Ast');
    //    $Ast->setIsPrivate(false);
    //    $Ast->setPlayer(
    //         $this->entityManager->getRepository(User::class)->findOneBy(['username' => "user"])
    //     );
    //    $manager->persist($Ast);

       $manager->flush();

        $prof = new Profession();
        $prof->setName('Łowca czarwnic');
        $prof->setTierNames(array('oprawca','Łowca czarwnic','Inkwizytor','Wielki Łowca'));
        $prof->setStatuses(array('b1','s3','s5','g2'));
    $manager->persist($prof);
    $manager->flush();
    }
}
