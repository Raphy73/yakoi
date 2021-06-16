<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Email'
                )
            ))
            ->add('name', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Nom'
                )
            ))
            ->add('firstName', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Prénom'
                )
            ))
            ->add('password', PasswordType::class, array(
                'attr' => array(
                    'placeholder' => 'Mot de passe'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
