<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;

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
       $hashedPassword = $this->passwordHasher->hashPassword($admin ,'root');
       $admin->setPassword($hashedPassword);

       $manager->persist($admin);
       


       $user = new User();
       $user->setUsername('user');  
       $user->setRoles(array('USER'));  
       $hashedPassword = $this->passwordHasher->hashPassword($user ,'rootuser');
       $user->setPassword($hashedPassword);

       $manager->persist($user);
       $manager->flush();


       //characters
       $ruben= new Character();
       $ruben->setName('Ruben');
       $ruben->setIsPrivate(true);
       $ruben->setPlayer(
            $this->entityManager->getRepository(User::class)->findOneBy(['username' => "admin"])
        );
       $manager->persist($ruben);

       $Nebur= new Character();
       $Nebur->setName('Nebur');
       $Nebur->setIsPrivate(0);
       $Nebur->setPlayer(
            $this->entityManager->getRepository(User::class)->findOneBy(['username' => "admin"])
        );
       $manager->persist($Nebur);

       $Ast= new Character();
       $Ast->setName('Ast');
       $Ast->setIsPrivate(false);
       $Ast->setPlayer(
            $this->entityManager->getRepository(User::class)->findOneBy(['username' => "user"])
        );
       $manager->persist($Ast);

       $manager->flush();
    }
}
