<?php

namespace App\Form;

use App\Entity\Appartement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AppartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TextareaType::class,[
                'label' => 'Description',
            ])
            ->add('prix', MoneyType::class, [
                'scale' => 9,
                'label' => 'Prix ',
                'currency' => 'CFA'
                ]
            )
            ->add('titre',TextType::class, [
                'label' => "Titre de l'appartement",
            ])
            ->add('imageFilename',TextType::class, [
                'label' => "Lien vers l'image",
            ])
            ->add('surface',NumberType::class, [
                'label' => 'Superficie en m2',
            ])
            ->add('chambres',NumberType::class, [
                'label' => 'Nombre de chambres',
            ])
            ->add('garage',NumberType::class, [
                'label' => 'Nombre de garages',
            ])
            ->add('salle_de_bains', Numbertype::class, [
                'label' => 'Nombre de salles de bain'
            ])
            ->add('photo', FileType::class, [
                'label' => 'image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
               
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appartement::class,
        ]);
    }
}
