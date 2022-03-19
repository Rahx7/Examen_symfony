<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Mail;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MailCustomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class , [
                'label'=>'votre prénom',
                // 'mapped' => false,
            ])
            ->add('nom', TextType::class , [
                'label'=>'votre nom',
                
            ])
            ->add('email', EmailType::class , [
                'label'=>'votre mail',
                
            ])
            ->add('rdv', DateTimeType::class , [
                'label'=>'date de rendez_vous',
                'widget' => 'single_text',
            ])

            ->add('agent', EntityType::class , [
                'label'=>'Agent en charge',
                'class'=> User::class,
                'attr'=>[
                    // 'class'=>'hidden',
                    'disabled'=>'disabled'
                ]   
            ])
            
            ->add('leBien', EntityType::class , [
                'label'=>"concerne l'immobilier",
                'class'=> Bien::class,
                'mapped'=>false,
                'attr'=>[
                    // 'class'=>'hidden',
                    'disabled'=>'disabled'
                ]   
            ])

            ->add('submit', SubmitType::class, [
                'label'=>'prendre rendez-vous',
                'attr'=>[
                    'class'=>'ui button primary'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method'=>'POST',
            'data_class' => Mail::class,
        ]);
    }
}
