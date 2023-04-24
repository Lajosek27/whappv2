<?php 
namespace App\Services;


use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Profession;


class professionService
{   
    private $tier;

    public function getTier(int $tier,Profession $prof) : array
    {
        $this->tier['name'] = $prof->getTierNames()[$tier];
        $this->tier['status'] = $prof->getStatuses()[$tier];



        return $this->tier;
    }
}
?>