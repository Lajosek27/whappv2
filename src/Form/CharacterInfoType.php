<?php

namespace App\Form;

use App\Entity\CharacterInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class CharacterInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('race',HiddenType::class,[
                'label' => 'Rasa:', 
                
            ],
                    
                )
            ->add('age', HiddenType::class,[
                'label' => 'Wiek:', 
                'required' => false,
               
            ])
            ->add('height', HiddenType::class,[
                'label' => 'Wzrost:', 
                'required' => false,
               
            ])
            ->add('hair',HiddenType::class,[
                'label' => 'Włosy:', 
                'required' => false,
             
            ])
            ->add('eyes',HiddenType::class,[
                'label' => 'Oczy:', 
                'required' => false,
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterInfo::class,
        ]);
    }
}
