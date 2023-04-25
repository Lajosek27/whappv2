<?php

namespace App\Controller;

use App\Entity\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\charactersService;
use App\Entity\CharacterInfo;
use App\Form\CharacterInfoType;
use App\Repository\ProfessionRepository;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;

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

        if($action == 'edit' && $character->getPlayer() !== $this->getUser() && $character->getGameMaster() !== $this->getUser() )
        {
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }

        
        
        $formInfo = $this->createForm(CharacterInfoType::class, $character->getInfo());

        
        return $this->render('character_sheet/index.html.twig', [
            'character' => $character,
            'edit' => $action==='edit'? true : false,
            'formInfo' => $formInfo,

        ]);
    }

    #[Route('/set/profession/{characterId}', name: 'app_set_profession',  requirements: ['characterId' => '\d+'])]
    public function setProfession(ProfessionRepository $profRepo,FormFactoryInterface $formFactory, EntityManagerInterface $manager,Request $request,int $characterId = 0)
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
        
        $character = $manager->getRepository(Character::class)->findOneBy(['id' => $characterId]);
        
        if( $character->getPlayer() !== $this->getUser() && $character->getGameMaster() !== $this->getUser() )
        {
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }

        $profs = $profRepo->findAll();
        
        $form = $formFactory->createBuilder()
        ->add('charcterId', HiddenType::class,[
            'attr' => ['value' => $character->getProfession() ? $character->getProfession()->getId() : 0 ]
            ])
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $input = $form->get('charcterId')->getData();
            if (!filter_var($input, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) !== false) {
                $this->addFlash('error', 'Coś poszło nie tak :/');
                return $this->render('character_sheet/setProfession.html.twig', [
                    'character' => $character,
                    'professions' => $profs,
                    'form' => $form->createView()
        
                ]);
            }

            
            $character->setProfession($profRepo->find($input));
            $character->setProfessionLv(0);
            $manager->persist($character);
            $manager->flush();
            

            $this->addFlash('succes', 'Zapisano zmiany' );
            return $this->redirectToRoute('app_character_sheet',[
                "characterId" => $characterId,
                'action' => 'edit'
            ]);
        }
        
        return $this->render('character_sheet/setProfession.html.twig', [
            'character' => $character,
            'professions' => $profs,
            'form' => $form->createView()

        ]);
    }
}
