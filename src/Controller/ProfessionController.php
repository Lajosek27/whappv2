<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionController extends AbstractController
{
    #[Route('/profession', name: 'app_profession')]
    public function index(): Response
    {
        return $this->render('profession/index.html.twig', [
            'controller_name' => 'ProfessionController',
        ]);
    }
}
