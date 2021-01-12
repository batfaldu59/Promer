<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeInformationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'disabled' => true
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Ancien mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre ancien mot de passe'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Vos mots de passe ne corespondent pas !',
                'required' => true,
                'mapped' => false,
                'label' => 'Mot de passe',
                'first_options' => ['label' => 'Tapez votre noouveau mot de passe'],
                'second_options' => ['label' => 'Confirmez votre nouveau mot de passe']
            ])
            ->add('nom', TextType::class, [
                'label' => "Nom",
                'disabled' => true
            ])
            ->add('numsiret', IntegerType::class, [
                'label' => "Numéro de siret",
                'disabled' => true
            ])
            ->add('telephone', IntegerType::class, [
                'label' => "Téléphone",
                'disabled' => true
            ])
            ->add('fax', IntegerType::class, [
                'label' => "Fax",
                'disabled' => true
            ])
            ->add('statutjuridique', TextType::class, [
                'label' => "Statut juridique",
                'disabled' => true
            ])
            ->add('codeAPE', TextType::class, [
                'label' => "Code APE",
                'disabled' => true
            ])
            ->add('numVoie', IntegerType::class, [
                'label' => "Numéro de voie",
                'disabled' => true
            ])
            ->add('rue', TextType::class, [
                'label' => "Nom de voie",
                'disabled' => true
            ])
            ->add('complementadresse', TextType::class, [
                'label' => "Compl. d'adresse",
                'disabled' => true
            ])
            ->add('codepostal', IntegerType::class, [
                'label' => "Code postal",
                'disabled' => true
            ])
            ->add('ville', TextType::class, [
                'label' => "Ville",
                'disabled' => true
            ])
            ->add('pays', TextType::class, [
                'label' => "Pays",
                'disabled' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
