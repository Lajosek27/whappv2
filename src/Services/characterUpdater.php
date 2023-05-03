<?php 
namespace App\Services;

use App\Entity\Character;
use App\Entity\Points;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;




class characterUpdater
{   
    

    public function __construct(
        private Security $security,
        private EntityManagerInterface $manager,
        private LoggerInterface $logger,
        private Request $request = new Request()
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
        $info = $char->getInfo();
        $infoDifferences = $this->validateInfo($info,$data);
        if(count($infoDifferences) > 0)
        {   
            $char->setInfo($info->denormalize($infoDifferences));
        }

      

        


        $this->manager->persist($char);
        $this->manager->flush();
        return $infoDifferences;
    }

    
    private function validateInfo($info,$data) : array
    {
       $arrayInfo = $info->normalize();
       $differences = [];

       foreach ($arrayInfo as $key => $value) {
            empty($value) ? $this->error('Musisz uzupełnić '.$key.'.'):'';
            if($value != $data[$key]){
                $this->logger->info('Różni się: '.$key);
                $differences[$key] = $data[$key];
            }
       }

       return $differences;
    }


    private function error(string $message)
    {
        $session = $this->request->getSession();
        $session->getFlashBag()->add('error', $message);

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