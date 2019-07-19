<?php

namespace App\Form\Restaurant;

use App\Entity\Restaurant\Restaurant;
use App\Form\Media\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add(
                'status',
                ChoiceType::class,
                [
                    'label' => 'Status',
                    'choices' => [
                        'active' => 1,
                        'inactive' => 0,
                    ],
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'media',
                MediaType::class,
                [
                    'label' => 'Photo',
                    'required' => true,
                    'additional_constraints' => [
                        new Image(),
                        new NotBlank(),
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Restaurant::class,
            ]
        );
    }
}
