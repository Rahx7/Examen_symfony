<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;

class SearchCustomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('piecemin', IntegerType::class, ['mapped' => false, 'label' =>"nbre de pièce min"])
            ->add('piecemax', IntegerType::class, ['mapped' => false, 'label' =>"nbre de pièce max"])
            ->add('surfacemin', IntegerType::class, ['mapped' => false, 'label' =>"surface min"])
            ->add('surfacemax', IntegerType::class, ['mapped' => false, 'label' =>"surface max"])
            ->add('prixmin', IntegerType::class, ['mapped' => false, 'label' =>"Prix min", ])
            ->add('prixmax', IntegerType::class, ['mapped' => false, 'label' =>"Prix max"])

            ->add('submit', SubmitType::class,[
                'attr' => ['class'=>'ui button secondary'],
                'label' =>"Rechercher"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            'method' =>'POST',
            'attr' => ['class'=>'ui form']
            // Configure your form options here  

        ]);
    }
}
