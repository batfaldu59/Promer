<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Intitulé',
                'attr' => ['placeholder' => 'Intitulé de l\'adresse de livraison']
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'Prénom de l\'interlocuteur']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Nom de l\'interlocuteur']
            ])
            ->add('numrue', IntegerType::class, [
                'label' => 'Numéro de voie',
                'attr' => ['placeholder' => 'Nom de voie de l\'adresse de livraison']

            ])
            ->add('rue', TextType::class, [
                'label' => 'Nom de voie',
                'attr' => ['placeholder' => 'Nom de voie de l\'adresse de livraison']
            ])
            ->add('complementadresee', TextType::class, [
                'label' => "Compl. d'adresse",
                'attr' => ['placeholder' => 'Complément d\'adresse de l\'adresse de livraison']
            ])
            ->add('codepostal', TextType::class, [
                'label' => 'Code postal',
                'attr' => ['placeholder' => 'Code postal de l\'adresse de livraison']
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => ['placeholder' => 'Ville de l\'adresse de livraison']
            ])
            ->add('pays', CountryType::class, [
                'label' => 'Pays'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter une adresse'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
