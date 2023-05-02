<?php

namespace App\Controller;

use App\Entity\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\charactersService;
use App\Entity\CharacterInfo;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\CharacterType;
use App\Repository\ProfessionRepository;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;

class CharacterSheetController extends AbstractController
{
    #[Route(
        '/character/sheet/{characterId}/{action}',
         name: 'app_character_sheet',
          requirements: [
            'characterId' => '\d+',
            'action' =>'show|edit'
            ])]
    public function index(charactersService $characterGetter,Request $request,EntityManagerInterface $manager,string $action='show',int $characterId = 0): Response
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

        if($action == 'edit' && $character->getPlayer() !== $this->getUser() && $character->getGameMaster() !== $this->getUser() )
        {
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }

        
        
        $form = $this->createForm(CharacterType::class);


        
        return $this->render('character_sheet/index.html.twig', [
            'character' => $character,
            'edit' => $action==='edit'? true : false,
            'formInfo' => $form,

        ]);
    }

    #[Route(
        '/customizing/profession/{characterId}/{action}',
         name: 'app_customizing_profession',
          requirements: [
            'characterId' => '\d+',
            'action' =>'show|edit'
            ])]
    public function customizingProfession(charactersService $characterGetter,FormFactoryInterface $formFactory,Request $request,EntityManagerInterface $manager,string $action='show',int $characterId = 0): Response
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

        if($action == 'edit' && $character->getPlayer() !== $this->getUser() && $character->getGameMaster() !== $this->getUser() )
        {
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }

        $form = $formFactory->createBuilder()
        ->add('professionLv',ChoiceType::class, [
            'choices'  => [
                $character->getProfession()->getTierNames()[0] => '0',
                $character->getProfession()->getTierNames()[1] => '1',
                $character->getProfession()->getTierNames()[2] => '2',
                $character->getProfession()->getTierNames()[3] => '3',
            ],
            'attr' => ['class' => 'form-control'],
            'label' => 'Poziom profesji:',
            
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Zapisz',
            'attr' => ['class' => 'btn btn-primary'],
            ])
        ->getForm();
        
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $character->setProfessionLv($form->get('professionLv')->getData());
        
            $manager->persist($character);
            $manager->flush();

            $this->addFlash('succes', 'Zapisano zmiany' );
            return $this->redirectToRoute('app_character_sheet',[
                'characterId' => $characterId,
                'action' => 'edit'
            ]);
        }

        
        return $this->render('character_sheet/customizing_profession.html.twig', [
            'character' => $character,
            'edit' => ($action==='edit' && $character->getGameMaster() !== $this->getUser())? true : false,
            'form' => $form->createView()

        ]);
    }

    
}
