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

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Vos mot de passe ne corespondent pas',
                'required' => false,
                'first_options' => ['label' => 'Votre mot de passe'],
                'second_options' => ['label' => 'Confirmez votre mot de passe']
            ])
            ->add('nom', TextType::class, [
                'label' => "Nom de l'entreprise"
            ])
            ->add('numsiret', IntegerType::class, [
                'label' => "Numéro de siret de l'entreprise"
            ])
            ->add('telephone', IntegerType::class, [
                'label' => "Tékeohone de l'entreprise"
            ])
            ->add('fax', IntegerType::class, [
                'label' => "fax de l'entreprise"
            ])
            ->add('statutjuridique', TextType::class, [
                'label' => "Statut juridique de l'entreprise"
            ])
            ->add('codeAPE', TextType::class, [
                'label' => "Code APE de l'entreprise"
            ])
            ->add('numVoie', IntegerType::class, [
                'label' => "Numéro de voie de l'entreprise"
            ])
            ->add('rue', TextType::class, [
                'label' => "Nom de rue de l'entreprise"
            ])
            ->add('complementadresse', TextType::class, [
                'label' => "Complément de rue de l'entreprise"
            ])
            ->add('codepostal', IntegerType::class, [
                'label' => "cp de l'entreprise"
            ])
            ->add('ville', TextType::class, [
                'label' => "Ville de l'entreprise"
            ])
            ->add('pays', TextType::class, [
                'label' => "Pays de l'entreprise"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
