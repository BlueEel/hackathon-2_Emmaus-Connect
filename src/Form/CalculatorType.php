<?php

namespace App\Form;

use App\Entity\Phone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('brand', TextType::class, [
            'label' => 'Marque: ',
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez indiquer la marque',
                ])],
        ])
        ->add('modele', TextType::class, [
            'label' => 'Modèle: ',
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez indiquer le modèle',
                ])],

        ])
        ->add('internalmemory', ChoiceType::class, [
            'placeholder' => 'Sélectionnez la mémoire interne',
            'label' => 'Mémoire interne: ',
            'choices' => [
                '16 Go' => '16',
                '32 Go' => '32',
                '64 Go' => '64',
                '128 Go' => '128',
                '256 Go' => '256',
                '512 Go' => '512',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez indiquer la Mémoire interne',
                ])],
        ])
        ->add('ram', ChoiceType::class, [
            'placeholder' => 'Sélectionnez la RAM',
            'choices' => [
                '2 Go' => '2',
                '4 Go' => '4',
                '6 Go' => '6',
                '8 Go' => '8',
                '12 Go' => '12',
                '16 Go' => '16',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez indiquer la RAM',
                ])],
        ])
            ->add('releaseYear', DateType::class, [
                'label' => 'Année',
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'format' => 'yyyy',
                'html5' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}
