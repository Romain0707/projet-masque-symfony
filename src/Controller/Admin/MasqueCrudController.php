<?php

namespace App\Controller\Admin;

use App\Entity\Masque;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MasqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Masque::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            NumberField::new('price'),
            AssociationField::new('user','Créer par',)->setFormTypeOptions([
                'by_reference' => true,
                'multiple' => false,
                'choice_label' => 'username',
            ]),
            AssociationField::new('colors','Couleurs') ->setFormTypeOptions([
                'by_reference' => false,
                'multiple' => true,
                'choice_label' => 'name',
            ]),
            ImageField::new('image_name')->setUploadDir('public/uploads/images'),
        ];
    }
    
}
