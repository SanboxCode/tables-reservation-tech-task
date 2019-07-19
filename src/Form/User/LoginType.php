<?php

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username',
            TextType::class,
            [
                'label' => 'Username',
                'required' => false,
            ]
        );
        $builder->add(
            'password',
            PasswordType::class,
            [
                'label' => 'Password',
                'required' => false,
            ]
        );
    }

    /**
     * @return null
     */
    public function getBlockPrefix()
    {

        return null;
    }
}
