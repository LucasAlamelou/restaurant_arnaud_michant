<?php

namespace App\Controller\Admin;

use App\Entity\CategoriesOfPlat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoriesOfPlatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoriesOfPlat::class;
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
