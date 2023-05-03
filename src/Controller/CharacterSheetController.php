<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\charactersService;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\CharacterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\characterUpdater;
use Psr\Log\LoggerInterface;


class CharacterSheetController extends AbstractController
{   
    
    #[Route(
        '/character/sheet/{characterId}/{action}',
         name: 'app_character_sheet',
          requirements: [
            'characterId' => '\d+',
            'action' =>'show|edit'
            ])]
    public function index(
        charactersService $characterGetter,
        Request $request,
        EntityManagerInterface $manager,
        characterUpdater $characterUpdater,
        LoggerInterface $logger,
        string $action='show',
        int $characterId = 0
        
    ): Response
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

        $gmMode = $this->getuser() === $character->getGameMaster() ? true : false;
        
        $form = $this->createForm(CharacterType::class);

        $dump= '';
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $info = $character->getInfo();
            // $info->setAge($form->get('age')->getData());
            // $info->setHeight($form->get('height')->getData());
            // $info->setHair($form->get('hair')->getData());
            // $info->setEyes($form->get('eyes')->getData());
            // $character->setInfo($info);

            // $points = $character->getPoints();
            // $points->setFate($form->get('fate')->getData());
            // $points->setLuck($form->get('luck')->getData());
            // $points->setResolve($form->get('resolve')->getData());
            // $points->setResilience($form->get('resilience')->getData());
            // $points->setSpeed($form->get('speed')->getData());
            // $points->setWalk($form->get('walk')->getData());
            // $points->setRun($form->get('run')->getData());
            // $character->setPoints($points);
            

            $dump = $characterUpdater->validateCharacter($character,$form->getData(),$gmMode,$logger);


            $manager->persist($character);
            $manager->flush();

            $this->addFlash('succes','Zapisano zmiany :)');
        }

        
        return $this->render('character_sheet/index.html.twig', [
            'character' => $character,
            'edit' => $action==='edit'? true : false,
            'gmMode' => $gmMode,
            'form' => $form,
            'currentExp' => (int) $character->getExp()->getFree() +  (int) $character->getExp()->getSpend()

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
            'form' => $form->createView(),
            
        ]);
    }

  
}
