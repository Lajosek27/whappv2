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
        $test = $characterGetter->getCharactersToCatalog($page);
        $maxPage = $characterGetter->getMaxNumPages();
        return $this->render('catalog/index.html.twig', [
            'test' => $test,
            'page' => $page,
            'maxPage' => $maxPage
        ]);
    }

    // #[Route('/catalog/{page}', name: 'app_catalog_page')]
    // public function catalogPage(int $page,charactersService $characterGetter): Response
    // {   
    //     $test = $characterGetter->getCharactersToCatalog($page);
        
    //     return $this->render('catalog/index.html.twig', [
    //         'test' => $test
    //     ]);
    // }


}
