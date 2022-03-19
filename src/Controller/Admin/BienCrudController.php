<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
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
            TextareaField::new('description'),

            SlugField::new('slug')
                ->setTargetFieldName('titre'),

            ImageField::new('photo','ma photo')
                ->setBasePath('upload/')
                ->setUploadDir('public/upload/')
                // ->setFormType(FileUploadType::class)
                // ->setFormTypeOption('allow_delete', false)
                // ->setFormTypeOption('upload_delete', function(File $file) { dump("coucou"); die(); })
                // ->setRequired(false),
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

            AssociationField::new('photos'),

        //     CollectionField::new('photos2',NULL)
        //     // ->allowAdd() 
        //     // ->allowDelete()
        //     // ->setEntryIsComplex(true)
        //         ->setEntryType(FileType::class)
            
        // //     ->setFormTypeOptions([
        // //     'by_reference' => 'false' 
        // // ]),

        ];
    }


    // public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
     
    //     $entityInstance->setAgent($this->getUser());
    //     $image = new File ($entityInstance->getPhoto());
    //     $imageName = md5(uniqid()) . '.' .$image->guessExtension();
    //     $image->move(
    //          $this->getParameter('upload_files'),
    //         $imageName
    //     );
        
    //     $entityInstance->setPhoto($imageName);
    //     $entityManager->persist($entityInstance);
    //     $entityManager->flush();

        
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
