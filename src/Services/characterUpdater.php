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

        $points = $char->getPoints();
        $pointsDifferences = $this->validatePoints($points,$data);
        if(count($pointsDifferences) > 0)
        {   
            $char->setPoints($points->denormalize($pointsDifferences));
        }

        
        
        
        
        $exp = $char->getExp();
        $expDifferences = $this->validatePoints($exp,$data);
        if(count($expDifferences) > 0)
        {   
            $char->setExp($exp->denormalize($expDifferences));
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
                // $this->logger->info('Różni się: '.$key);
                $differences[$key] = $data[$key];
            }
       }

       return $differences;
    }

    private function validatePoints($points,$data) : array
    {
       $arrayPoints = $points->normalize();
       $differences = [];

       foreach ($arrayPoints as $key => $value) {
            empty($value) ? $this->error('Musisz uzupełnić '.$key.'.'):'';
            if($value != $data[$key]){
                $differences[$key] = $data[$key];
            }
       }

       return $differences;
    }

   
}


?>