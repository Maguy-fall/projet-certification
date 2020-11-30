<?php

namespace App\Form;

use App\Entity\Terrain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TerrainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du terrain',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('prix',NumberType::class, [
                'scale' => 2,
                'label' => 'Prix en CFA',
            ])
            ->add('surface', NumberType::class, [
                'label' => 'Superficie en m2',
            ])
            ->add('imageFilename', TextType::class, [
                'label' => "Lien vers l'image",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Terrain::class,
        ]);
    }
}
