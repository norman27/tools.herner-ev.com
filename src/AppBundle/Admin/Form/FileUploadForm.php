<?php

namespace AppBundle\Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Image;

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
                    'label' => false,
                    'constraints' => new Image([
                        'maxSize' => '1M',
                        'minWidth' => 896,
                        'maxWidth' => 896,
                        'minHeight' => 512,
                        'maxHeight' => 512
                    ])
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