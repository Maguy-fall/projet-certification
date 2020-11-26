<?php

namespace App\Form;

use App\Entity\Appartement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdminAppartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => "Titre de l'appartement"
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Prix de vente'
            ])
            ->add('imageFilename', TextType::class, [
                'label' => "lien vers l'image",
               
            ])
            ->add('surface', IntegerType::class, [
                'label' => 'superficie',
            ])
            ->add('chambres', IntegerType::class, [
                'label' => 'nombre de chambres'
            ])
            ->add('garage', Integer::class, [
                'label' => 'nombre de garages'
            ])
            ->add('salle_de_bains', IntegerType::class, [
                'label' => 'nombre de salle de bains'
            ])
            ->add('envoyer', SubmitType::class, [
                'label' => 'enregister'
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
