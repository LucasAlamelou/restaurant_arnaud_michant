<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Image;

class PictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Picture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('imageName')->setHelp('Veuillez utiliser le même nom de l\'image avec l\'extension ! (ex: image.jpg)'),
            ImageField::new('imageFile')
                ->setBasePath('public/images/')
                ->setUploadDir('public/images/')
                ->setRequired(true)
                ->setHelp('Format accepter: jpg, jpeg, png, gif')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setFormTypeOption('constraints', [
                    new Image()
                ])

        ];
    }
}
