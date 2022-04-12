<?php

namespace App\Form;

use App\Entity\Actualite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ActualiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('textActu', TextareaType::class, [
                'attr' => array('cols' => '120', 'rows' => '15')])
            ->add('fichierImage', VichImageType::class,[
                'image_uri' => false,
                'required'      => false,
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true

            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actualite::class,
        ]);
    }
}
