<?php

namespace App\Form\Table;

use App\Entity\Restaurant\Restaurant;
use App\Entity\Table\Table;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('capacity', NumberType::class)
            ->add('number', NumberType::class)
            ->add(
                'restaurant',
                EntityType::class,
                [
                    'class' => Restaurant::class,
                    'label' => 'Restaurant',
                    'placeholder' => 'Choose restaurant',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('r')
                            ->orderBy('r.title', 'ASC');
                    },
                    'choice_label' => function ($choice) {
                        return '(ID: '.$choice->getId().') '.$choice->getTitle();
                    },
                    'attr' => [
                        'class' => 'select-restaurant',
                    ],
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
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
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Table::class,
            ]
        );
    }
}
