<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\File;
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
            TextField::new('imageName')
                ->setHelp('Veuillez utiliser le même nom de l\'image avec l\'extension ! (ex: image.jpg)'),
            ImageField::new('imageFile')
                ->setBasePath('images/')
                ->setUploadedFileNamePattern('[name].[extension]')
                ->setUploadDir('public/images/')
                ->setHelp('Format accepter: jpg, jpeg, png, gif'),
            BooleanField::new('isForMobile')
                ->setRequired(true)
        ];
    }
}
