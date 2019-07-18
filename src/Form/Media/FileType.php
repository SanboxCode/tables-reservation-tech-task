<?php

namespace App\Form\Media;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FileType
 */
class FileType extends \Symfony\Component\Form\Extension\Core\Type\FileType
{
    /**
     * Default config
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(
            [
                'label' => false,
            ]
        );
    }
}
