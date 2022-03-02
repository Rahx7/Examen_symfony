<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MailCustomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class , [
                'label'=>'votre prénom',
                'mapped' => false,
            ])
            ->add('nom', TextType::class , [
                'label'=>'votre nom',
                'mapped' => false,
            ])
            ->add('mail', EmailType::class , [
                'label'=>'votre mail',
                'mapped' => false,
            ])
            ->add('RDV', DateType::class , [
                'label'=>'date de rendez_vous',
                'mapped' => false,
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
            // 'action'=> $this->redirectToRoute('mail')
        ]);
    }
}
