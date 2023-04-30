<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Character;
use App\Entity\Profession;

use Doctrine\ORM\EntityManagerInterface;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(EntityManagerInterface $manager): Response
    {   
        if(!$this->getUser() || !in_array('ADMIN', $this->getUser()->getRoles(), true))
        {   
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }
        $char = $manager->getRepository(Character::class)->findOneBy(['id' => 5]);
        
        $test = $manager->getRepository(Profession::class)->findOneBy(['id' => $char->getProfession()]);

        return $this->render('test/index.html.twig', [
            'test' => isset($test) ? $test : "Brak obiektu test" 
        ]);
    }
}
