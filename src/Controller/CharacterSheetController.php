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


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $this->addFlash('error', 'controller:' .  $form->get('race')->getData());
            // $validation = $this->saveCharacter(
            //     $form,
            //     $character,
            //     $manager
            // );
            $character->validate();
        }

        
        return $this->render('character_sheet/index.html.twig', [
            'character' => $character,
            'edit' => $action==='edit'? true : false,
            'form' => $form,

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

    private function saveCharacter($form,$character,$manager){
        
        
        $info = $character->getInfo();
        !empty($form->get('race')->getData()) ?  $info->setRace($form->get('race')->getData()) : '';
        !empty($form->get('race')->getData()) ?  $info->setRace($form->get('race')->getData()) : '';
        !empty($form->get('race')->getData()) ?  $info->setRace($form->get('race')->getData()) : '';
        !empty($form->get('race')->getData()) ?  $info->setRace($form->get('race')->getData()) : '';
        !empty($form->get('race')->getData()) ?  $info->setRace($form->get('race')->getData()) : '';

        $info->setAge($form->get('age')->getData());
        $info->setHeight($form->get('height')->getData());
        $info->setHair($form->get('hair')->getData());
        $info->setEyes($form->get('eyes')->getData());
        $character->setInfo($info);

        $points = $character->getPoints();
        $points->setFate($form->get('fate')->getData());
        $points->setLuck($form->get('luck')->getData());
        $points->setResolve($form->get('resolve')->getData());
        $points->setResilience($form->get('resilience')->getData());
        $character->setPoints($points);
        
        $manager->persist($character);
        $manager->flush();
    } 
}
