<?php

namespace App\Controller\Admin;

use App\Entity\PlatOfRestaurant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlatOfRestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlatOfRestaurant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setRequired(true),
            TextEditorField::new('description'),
            NumberField::new('price')->setRequired(true),
            AssociationField::new('categoriesOfPlat')
        ];
    }
}
