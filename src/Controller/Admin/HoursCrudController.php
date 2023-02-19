<?php

namespace App\Controller\Admin;

use App\Entity\Hours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hours::class;
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
