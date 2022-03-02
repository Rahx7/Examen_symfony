<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bien::class;
    }

    // public function __construct(Request $request)
    // {
    //     $this->request = $request;
    // }
    
    public function configureFields(string $pageName): iterable
    {
        // dump($this->getParameter('upload_files'));
        return [
            // IdField::new('id'),
            TextField::new('titre'),
            TextAreaField::new('description'),

            SlugField::new('slug')
                ->setTargetFieldName('titre'),

            ImageField::new('photo')
                // ->setBasePath('C:/wamp64/tmp')
                ->setUploadDir('public/upload/')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
            
            IntegerField::new('room', 'nombre de chambre'),
            IntegerField::new('floor', 'nom de pièces'),
            NumberField::new('surface', 'surface habitable'),
            NumberField::new('prix', 'prix du bien'),

            ChoiceField::new('type', 'le type de bien')
                ->autocomplete()
                ->setChoices([  'villa'=>'villa',
                                'appartement'=>'appartement',
                                'duplex'=>'duplex']),

            ChoiceField::new('typeTransac', 'le type de transaction')
                ->autocomplete()
                ->setChoices([  'louer'=>'louer',
                                'acheter'=>'Acheter']),

            IntegerField::new('etage', 'Etage'),
            IntegerField::new('surface_terrain', 'surface du terrain'),

            DateField::new('date_construction', 'date de construction'),

            TextareaField::new('adresse'),

            ArrayField::new('options'),

            AssociationField::new('agent'),

        ];
    }


    // public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
     
    //     // dump($entityInstance);
    //     // dump($entityManager);

    //     // die();
        
    // }

    // public function createEntity(string $entity)
    // {
    //     //  dump($this->request);
    //     dump($entity);
    //     // die();
        
    // }

    // public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     $entityManager->persist($entityInstance);

        
    //     dump($entityInstance);
    //     die();
    //     $entityManager->flush();
    // }
    
}
