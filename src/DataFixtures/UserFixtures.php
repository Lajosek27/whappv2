<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
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
    }
}
