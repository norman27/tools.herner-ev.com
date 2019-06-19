<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FileUploadForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'file',
                FileType::class,
                [
                    'label' => false
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Upload',
                    'attr' => [
                        'class' => 'btn btn-primary mt-3'
                    ]
                ]
            );
    }
}