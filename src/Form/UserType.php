<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => 'Prénom',   
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('email', EmailType::class)
            ->add('address', TextareaType::class, [
                'required' => false,
                'label' => 'Adresse',
            ])
            ->add('img', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Avatar',
                'attr' => [
                    'placeholder' => 'ex: avatar.png'
                ]
            ])
            ->add('Roles', ChoiceType::class, [
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    'Client' => 'ROLE_USER',   
                ],
            ])
        ;
        //Data transformer
        $builder->get('Roles')
        ->addModelTransformer(new CallbackTransformer(
            function ($rolesArray) {
                //transform the array to a string
                return count($rolesArray)? $rolesArray[0]: null;
            },
            function ($rolesString) {
                //transform the string back to an array
                return [$rolesString];
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
