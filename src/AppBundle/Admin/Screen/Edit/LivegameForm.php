<?php

namespace AppBundle\Admin\Screen\Edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Hockey\Club;
use AppBundle\Entity\Joomla\Banner;
use Doctrine\ORM\EntityManager;

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
                        'class' => 'js-addable-list'
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
                'sponsoren',
                ChoiceType::class,
                [
                    'multiple' => true,
                    'required' => false,
                    'choices' => $this->getBanners()
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