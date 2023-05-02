<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Profession;



class ProfessionFixtures extends Fixture 
{   
    public const PROF_WITH_HUNTER = 'Łowca czarownic';
    public const PROF_FLAX = 'Flax';
    public const PROF_BIMBROWNIK = 'Bimbrownik';

    public function load(ObjectManager $manager): void
    {   
        
        $prof = new Profession();
        $prof->setName('Łowca czarownic');
        $prof->setTierNames(array('oprawca','Łowca czarwnic','Inkwizytor','Wielki Łowca'));
        $prof->setStatuses(array('B1','S3','S5','G2'));
        $prof->setGrupe('Wojownicy');
        $prof->setCreatorName('Lajosek');
        $manager->persist($prof);
       
        $prof2 = new Profession();
        $prof2->setName('Obibok');
        $prof2->setTierNames(array('Leń','Obibok','Opierdalacz','Menager'));
        $prof2->setStatuses(array('B2','S2','S4','Z1'));
        $prof2->setGrupe('Mieszczanie');
        $prof2->setCreatorName('Mysurek');
        $manager->persist($prof2);
        
        
        $prof3 = new Profession();
        $prof3->setName('Bimbrownik');
        $prof3->setTierNames(array('Uczeń Bimbrownika','Bimbrownik','Stary Bimbrownik','Król Samogonu'));
        $prof3->setStatuses(array('B2','B5','S1','S3'));
        $prof3->setGrupe('Wieśniak');
        $prof3->setCreatorName('Liju');
        $manager->persist($prof3);


        $manager->flush();


        $this->addReference(self::PROF_WITH_HUNTER, $prof);
        $this->addReference(self::PROF_FLAX, $prof2);
        $this->addReference(self::PROF_BIMBROWNIK, $prof3);
    }

  
}