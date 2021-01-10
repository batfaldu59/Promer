<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            SlugField::new('slug')->setTargetFieldName('nom'),
            ImageField::new('imageProduit')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('reference'),
            TextareaField::new('description'),
            TextareaField::new('composition'),
            TextareaField::new('modEmploi'),
            TextareaField::new('precautionEmploi'),
            TextField::new('conditionnement'),
            TextField::new('conditionnement'),
            IntegerField::new('poidsBrut'),
            IntegerField::new('poidsNet'),
            IntegerField::new('nbUniteColis'),
            IntegerField::new('nbUnitePalette'),
            TextField::new('densite'),
            TextField::new('pH'),
            ColorField::new('couleur'),
            TextField::new('dimensionUniteProduit'),
            TextField::new('dimensionUniteColis'),
            TextField::new('dimensionPalette'),
            TextField::new('nomChimique'),
            MoneyField::new('prixColis')->setCurrency('EUR'),
            MoneyField::new('prixPalette')->setCurrency('EUR'),
            AssociationField::new('categorie')
        ];
    }

}
