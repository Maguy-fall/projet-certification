<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class VendreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Entrez votre nom',
            ])
            ->add('numero_de_telephone', TelType::class, [
                'label' => 'Numéro de téléphone',
            ] )
            ->add('email', EmailType::class, [
                'label' => 'Mettez votre email',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Tapez votre message',
            ])
            ->add('envoyer', SubmitType::class)
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
