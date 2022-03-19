<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            ImageField::new('nom','ma photo')
                ->setBasePath('upload/')
                ->setUploadDir('public/upload/')
                // ->setFormType(FileUploadType::class)
                // ->setFormTypeOption('allow_delete', false)
                // ->setFormTypeOption('upload_delete', function(File $file) { dump("coucou"); die(); })
                // ->setRequired(false),
                ->setUploadedFileNamePattern('[randomhash].[extension]'),

            TextField::new('description'),
            AssociationField::new('bien'),


        ];
    }
    
}
