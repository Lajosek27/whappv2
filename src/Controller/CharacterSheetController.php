<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\charactersService;
use App\Entity\CharacterInfo;
use App\Form\CharacterInfoType;


class CharacterSheetController extends AbstractController
{
    #[Route(
        '/character/sheet/{characterId}/{action}',
         name: 'app_character_sheet',
          requirements: [
            'page' => '\d+',
            'action' =>'show|edit'
            ])]
    public function index(charactersService $characterGetter,string $action='show',int $characterId = 0): Response
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
        
        $formInfo = $this->createForm(CharacterInfoType::class, $character->getInfo());

        
        return $this->render('character_sheet/index.html.twig', [
            'character' => $character,
            'edit' => $action==='edit'? true : false,
            'formInfo' => $formInfo,

        ]);
    }
}
