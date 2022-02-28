<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Groupe;
use Doctrine\DBAL\Types\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('heureDebut',\Symfony\Component\Form\Extension\Core\Type\TimeType::class,[
                'widget' => 'single_text'
            ])
            ->add('dureeMinutes')
            ->add('groupe', EntityType::class,[
                'class'=>Groupe::class,
                'choice_label'=>'niveau',
                'multiple'=>true,
                'expanded'=>true
            ])
            ->add('commentaire', TextareaType::class,[
                'required'=>false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
