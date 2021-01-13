<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => ['placeholder' => 'Adresse email']
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Vos mots de passe ne correspondent pas !',
                'required' => true,
                'label' => 'Mot de passe',
                'first_options' => ['label' => 'Tapez le mot de passe*'],
                'second_options' => ['label' => 'Confirmez le mot de passe*']
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('numsiret', IntegerType::class, [
                'label' => 'Siret',
                'attr' => ['placeholder' => 'Numéro de siret']
            ])
            ->add('telephone', IntegerType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Numéro de téléphone']
            ])
            ->add('fax', IntegerType::class, [
                'label' => 'Fax',
                'attr' => ['placeholder' => 'Numéro de fax']
            ])
            ->add('statutjuridique', TextType::class, [
                'label' => 'Statut juridique',
                'attr' => ['placeholder' => 'Code du statut juridique']
            ])
            ->add('codeAPE', TextType::class, [
                'label' => 'Code APE',
                'attr' => ['placeholder' => 'Code APE']
            ])
            ->add('numVoie', IntegerType::class, [
                'label' => 'Numéro de voie',
                'attr' => ['placeholder' => 'Numéro de voie']
            ])
            ->add('rue', TextType::class, [
                'label' => 'Nom de voie',
                'attr' => ['placeholder' => 'Nom de voie']
            ])
            ->add('complementadresse', TextType::class, [
                'label' => 'Compl. d\'adresse',
                'attr' => ['placeholder' => 'Complément d\'adresse']
            ])
            ->add('codepostal', IntegerType::class, [
                'label' => 'Code postal',
                'attr' => ['placeholder' => 'Code postal']
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => ['placeholder' => 'Ville']
            ])
            ->add('pays', CountryType::class, [
                'label' => 'Pays'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
