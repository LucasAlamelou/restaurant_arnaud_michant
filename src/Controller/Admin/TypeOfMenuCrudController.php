<?php

namespace App\Controller\Admin;

use App\Entity\TypeOfMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeOfMenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeOfMenu::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
