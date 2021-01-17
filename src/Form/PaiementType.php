<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NumCard', TextType::class, [
                'label' => 'Numéro de carte',
                'required' => true,
                'attr' => [
                    'placeholder' => '1234 5678 XXXX XXXX'
                ]
            ])
            ->add('datExpir', DateType::class, [
                'label' => "Date d'expiration",
                'required' => true,
                'format' => 'yyyy-MM-dd'


            ])
            ->add('CGV', TextType::class, [
                'label' => "CGV",
                'required' => true

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
