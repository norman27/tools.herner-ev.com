<?php

namespace AppBundle\Form;

use AppBundle\Repository\FilesRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ImageForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $files = new FilesRepository();
        //@TODO remove duplicate call
        $images = array_combine(array_keys($files->getAllFiles()), array_keys($files->getAllFiles()));

        $builder->add('images', CollectionType::class, [
                'attr' => ['class' => 'js-addable-list'],
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'entry_type' => ChoiceType::class,
                'entry_options'  => [
                    'choices'  => $images,
                    'placeholder' => '---'
                ],
                'prototype' => true,
                'required' => false
            ])
            ->add('extimages', CollectionType::class, [
                'attr' => [
                    'class' => 'js-addable-list'
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'ext. URL',
                'delete_empty' => true,
                'entry_type' => TextType::class,
                'prototype' => true,
                'required' => false
            ])
            ->add('timer', IntegerType::class, [
                'empty_data' => '10',
                'required' => false,
                'attr' => [
                    'class' => 'js-data-help',
                    'data-help' => 'Anzahl Sekunden für Übergang, <code>default=10</code>.'
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
        ;
    }
}