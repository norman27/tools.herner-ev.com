<?php

namespace AppBundle\Admin\Screen\Edit;

use AppBundle\Screen\FilesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ImageForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $files = new FilesRepository();

        $builder
            ->add(
                'images',
                CollectionType::class,
                [
                    'attr' => [
                        'class' => 'js-addable-list' //@TODO implement
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'entry_type' => ChoiceType::class,
                    'entry_options'  => [
                        'choices'  => $files->getAll(),
                        'placeholder' => '---'
                    ],
                    'prototype' => true,
                ]
            )
            ->add(
                'timer',
                IntegerType::class,
                [
                    'empty_data' => '10',
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Save'
                ]
            )
        ;
    }
}