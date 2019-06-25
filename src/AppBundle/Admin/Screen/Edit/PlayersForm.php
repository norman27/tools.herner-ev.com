<?php

namespace AppBundle\Admin\Screen\Edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PlayersForm extends AbstractType
{
    use JoomlaHelperTrait;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add(
                'id',
                ChoiceType::class,
                [
                    'choices' => $this->getCategories('com_hockeymanager_team')
                ]
            )
            ->add(
                'players',
                CollectionType::class,
                [
                    'attr' => [
                        'class' => 'js-addable-list' //@TODO implement
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'entry_type' => IntegerType::class,
                    'prototype' => true,
                    'required' => false
                ]
            )
            ->add(
                'timer',
                IntegerType::class,
                [
                    'empty_data' => '5',
                    'required' => false,
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