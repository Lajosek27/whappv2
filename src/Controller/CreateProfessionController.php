<?php

namespace App\Controller;

use App\Entity\Profession;
use App\Entity\Character;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Repository\ProfessionRepository;


class CreateProfessionController extends AbstractController
{
    #[Route('/create/profession/{characterId}', name: 'app_create_profession', requirements: ['characterId' => '\d+'])]
    public function index(Request $request, EntityManagerInterface $manager,int $characterId): Response
    {   
        if(!$this->getUser())
        {   
            $this->addFlash('error', 'Nie posiadasz dostępu do rządanego zasobu :/');
            return $this->redirectToRoute('app_login');
        }
        
        $form = $this->createFormBuilder()
            ->add('name',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Nazwa profesji:'
            ])
            ->add('grupe',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Klasa:'
            ])
            ->add('tierName1',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Nazwa pierwszego poziomu:'
            ])
            ->add('tierName2',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Nazwa drugiego poziomu:'
            ])
            ->add('tierName3',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Nazwa trzeciego poziomu:'
            ])
            ->add('tierName4',TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Nazwa czwartego poziomu:'
            ])
            ->add('status1',ChoiceType::class, [
                'choices'  => [
                    'Brąz' => [
                        'B1' => 'B1',
                        'B2' => 'B2',
                        'B3' => 'B3',
                        'B4' => 'B4',
                        'B5' => 'B5',
                    ],
                    'Srebro' => [
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                        'S4' => 'S4',
                        'S5' => 'S5',
                    ],
                    'Złoto' => [
                        'Z1' => 'Z1',
                        'Z2' => 'Z2',
                        'Z3' => 'Z3',
                        'Z4' => 'Z4',
                        'Z5' => 'Z5',
                    ]
                    
                ],
                'attr' => ['class' => 'form-control'],
                'label' => 'Status:'
            ])
            ->add('status2',ChoiceType::class, [
                'choices'  => [
                    'Brąz' => [
                        'B1' => 'B1',
                        'B2' => 'B2',
                        'B3' => 'B3',
                        'B4' => 'B4',
                        'B5' => 'B5',
                    ],
                    'Srebro' => [
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                        'S4' => 'S4',
                        'S5' => 'S5',
                    ],
                    'Złoto' => [
                        'Z1' => 'Z1',
                        'Z2' => 'Z2',
                        'Z3' => 'Z3',
                        'Z4' => 'Z4',
                        'Z5' => 'Z5',
                    ]
                    
                ],
                'attr' => ['class' => 'form-control'],
                'label' => 'Status:'
            ])
            ->add('status3',ChoiceType::class, [
                'choices'  => [
                    'Brąz' => [
                        'B1' => 'B1',
                        'B2' => 'B2',
                        'B3' => 'B3',
                        'B4' => 'B4',
                        'B5' => 'B5',
                    ],
                    'Srebro' => [
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                        'S4' => 'S4',
                        'S5' => 'S5',
                    ],
                    'Złoto' => [
                        'Z1' => 'Z1',
                        'Z2' => 'Z2',
                        'Z3' => 'Z3',
                        'Z4' => 'Z4',
                        'Z5' => 'Z5',
                    ]
                    
                ],
                'attr' => ['class' => 'form-control'],
                'label' => 'Status:'
            ])
            ->add('status4',ChoiceType::class, [
                'choices'  => [
                    'Brąz' => [
                        'B1' => 'B1',
                        'B2' => 'B2',
                        'B3' => 'B3',
                        'B4' => 'B4',
                        'B5' => 'B5',
                    ],
                    'Srebro' => [
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                        'S4' => 'S4',
                        'S5' => 'S5',
                    ],
                    'Złoto' => [
                        'Z1' => 'Z1',
                        'Z2' => 'Z2',
                        'Z3' => 'Z3',
                        'Z4' => 'Z4',
                        'Z5' => 'Z5',
                    ]
                    
                ],
                'attr' => ['class' => 'form-control'],
                'label' => 'Status:'
            ])
            ->add('tierNames',HiddenType::class)
            ->add('statuses',HiddenType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Utwórz',
                'attr' => ['class' => 'btn btn-primary'],
                ])
        ->getForm();



        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $input = $form->get('charcterId')->getData();
            
            $prof = new Profession();

            $prof->setName( $form->get('name')->getData());
            $prof->setGrupe( $form->get('grupe')->getData());
            
            $prof->setTierNames(array(
                $form->get('tierName1')->getData(),
                $form->get('tierName2')->getData(),
                $form->get('tierName3')->getData(),
                $form->get('tierName4')->getData()
            ));
            
            $prof->setStatuses(array(
                $form->get('status1')->getData(),
                $form->get('status2')->getData(),
                $form->get('status3')->getData(),
                $form->get('status4')->getData()
            ));

            $prof->setCreatorName($this->getUser()->getUsername());
            $manager->persist($prof);
            $manager->flush();

            $this->addFlash('succes', 'Zapisano zmiany' );
            return $this->redirectToRoute('app_set_profession',[
                'characterId' => $characterId
            ]);
        }
        return $this->render('profession/index.html.twig', [
            'form' => $form
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
        
        return $this->render('profession/setProfession.html.twig', [
            'character' => $character,
            'professions' => $profs,
            'form' => $form->createView()

        ]);
    }
}
