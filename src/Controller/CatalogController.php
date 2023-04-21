<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $test = $entityManager->getRepository(User::class)->findOneBy(['username' => "admin"]);
        return $this->render('catalog/index.html.twig', [
            'controller_name' => $test,
        ]);
    }
}
