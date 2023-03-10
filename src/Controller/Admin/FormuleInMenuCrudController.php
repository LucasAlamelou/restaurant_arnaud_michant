<?php

namespace App\Controller\Admin;

use App\Entity\FormuleInMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class FormuleInMenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormuleInMenu::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextareaField::new('description')->setRequired(true),
            NumberField::new('price')->setRequired(true),
            AssociationField::new('TypeOfMenu'),

        ];
    }
}
