<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\charactersService;

class MyCharactersController extends AbstractController
{
    #[Route('/my/characters/{page}', name: 'app_my_characters', requirements: ['page' => '\d+'])]
    public function index(charactersService $characterGetter,int $page = 1): Response
    {   
        if(!$this->getUser()){return $this->redirectToRoute('app_login');}

        $characters = $characterGetter->getUserCharacters(
            $this->getUser()->getId(),
            'both',
            $page
        );
        $maxPage = $characterGetter->getMaxNumPages();


        return $this->render('my_characters/index.html.twig', [
            'characters' => $characters,
            'page' => $page,
            'maxPage' => $maxPage
        ]);
    }
}
