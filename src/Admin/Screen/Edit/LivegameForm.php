<?php

namespace App\Admin\Screen\Edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class LivegameForm extends AbstractType
{
    use JoomlaHelperTrait;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $clubs = $this->getClubs();

        $builder
            ->add(
                'hometeam',
                ChoiceType::class,
                [
                    'choices' => $clubs
                ]
            )
            ->add(
                'homescore',
                IntegerType::class
            )
            ->add(
                'awayteam',
                ChoiceType::class,
                [
                    'choices' => $clubs
                ]
            )
            ->add(
                'awayscore',
                IntegerType::class
            )
            ->add(
                'goals',
                CollectionType::class,
                [
                    'attr' => [
                        'class' => 'js-symfony-collection'
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'entry_type' => TextType::class,
                    'prototype' => true,
                    'required' => false
                ]
            )
            ->add(
                'sponsors',
                ChoiceType::class,
                [
                    'multiple' => true,
                    'required' => false,
                    'choices' => $this->getBanners(),
                    'attr' => ['size' => 10]
                ]
            )
        ;
    }


}