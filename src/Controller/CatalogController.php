<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\charactersService;

class CatalogController extends AbstractController
{
    #[Route('/catalog/{page}', name: 'app_catalog' , requirements: ['page' => '\d+'])]
    public function index(charactersService $characterGetter,int $page = 1): Response
    {   
        if(!$this->getUser())
        {   
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }

        $characters = $characterGetter->getCharactersToCatalog($this->getUser()->getId(),$page);
        $maxPage = $characterGetter->getMaxNumPages();


        return $this->render('catalog/index.html.twig', [
            'characters' => $characters,
            'page' => $page,
            'maxPage' => $maxPage
        ]);
    }


}
