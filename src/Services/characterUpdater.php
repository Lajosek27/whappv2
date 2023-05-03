<?php 
namespace App\Services;

use App\Entity\Character;
use App\Entity\Points;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class characterUpdater
{   
    

    public function __construct(
        private Security $security,
        private EntityManagerInterface $manager,
        private LoggerInterface $logger
          )
    {

    }


    public function validateCharacter($char,$data,$gmMode)
    {
        /**
         * sprawdz różnice w postaciach
         * jesli nie gmMODE
         *      to sprawdz czy może się zminić
         *          Jeśli tak to odejmij exp 
         *          jeśli nie to return informacje  
         * Dodaj info o zmianach
         * zmień i zapisz
         * 
         *      
         */

        $infoDifferences = $this->validateInfo($char->getInfo(),$data);
        if($infoDifferences > 0)
        {

        }
    }

    private function validateInfo($info,$data)
    {
       
    }
    // public function changeEXP(Character $char) : bool
    // {

    //     $user = $this->security->getUser();
    //     if(($char->getGameMaster() != Null && $char->getGameMaster() != $user) || ($char->getGameMaster() == Null && $char->getPlayer() != $user)){return false;}
        
    //     $exp = $char->getExp();
    //     return true;
    // }

}


?>