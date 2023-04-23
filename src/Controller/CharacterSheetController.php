<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\charactersService;

class CharacterSheetController extends AbstractController
{
    #[Route('/character/sheet/{characterId}', name: 'app_character_sheet', requirements: ['page' => '\d+'])]
    public function index(charactersService $characterGetter,int $characterId = 0): Response
    {
        if(!$this->getUser())
        {   
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }
        if($characterId <= 0)
        {   
            $this->addFlash('error', 'Nie ma takiej postaci :/');
            return $this->redirectToRoute('app_catalog');
        }
        $character = $characterGetter->getCharacter($characterId);
        
        return $this->render('character_sheet/index.html.twig', [
            'character' => $character,
        ]);
    }
}
