<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {   
        if(!$this->getUser() || !in_array('ADMIN', $this->getUser()->getRoles(), true))
        {   
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('test/index.html.twig', [
            'test' => isset($test) ? $test : "Brak obiektu test" 
        ]);
    }
}
