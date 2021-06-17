<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Nom du produit'
                )
            ))
            ->add('note', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Note Yakoi'
                )
            ))
            ->add('description', TextareaType::class, array(
                'attr' => array(
                    'placeholder' => 'Description'
                )
            ))
            ->add('reparabilite', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Indice de réparabilité'
                )
            ))
            ->add('coutenergetique', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Coût énergétique'
                )
            ))
            ->add('country', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Pays'
                )
            ))
            ->add('brand', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Marque'
                )
            ))
            ->add('Category', EntityType::class, ["class" => Category::class, "choice_label" => "name"])
            ->add('image', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Image'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}