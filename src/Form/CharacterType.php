<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class CharacterType extends AbstractType
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
            // ->add('fate',HiddenType::class,[
            //     'label' => 'Punkty Przeznaczenia:', 
            //     'required' => false,
                
            // ])
            // ->add('resolve',HiddenType::class,[
            //     'label' => 'Punkty Bohatera:', 
            //     'required' => false,
                
            // ])
            // ->add('luck',HiddenType::class,[
            //     'label' => 'Punkty Szczęścia:', 
            //     'required' => false,
                
            // ])
            // ->add('resilience',HiddenType::class,[
            //     'label' => 'Punkty Deterrminacji:', 
            //     'required' => false,
                
            // ])
        ;
    }

   
}
