<?php

namespace App\Controller\Admin;

use App\Entity\UserClient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserClient::class;
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
