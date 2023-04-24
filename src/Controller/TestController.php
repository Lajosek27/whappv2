<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        $prof = $manager->getRepository(Profession::class)->findOneBy(['id' => 1]);
        $test = $prof->getTier(1);


        return $this->render('test/index.html.twig', [
            'test' => isset($test) ? $test : "Brak obiektu test" 
        ]);
    }
}
