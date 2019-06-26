<?php

namespace AppBundle\Admin\Screen\Edit;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;

class TableForm extends AbstractType
{
    use JoomlaHelperTrait;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'caption',
                TextType::class,
                [
                    'required' => false
                ]
            )
            ->add(
                'id',
                ChoiceType::class,
                [
                    'choices' => $this->getCategories('com_hockeymanager_table')
                ]
            )
            ->add(
                'font',
                IntegerType::class,
                [
                    'attr' => [
                        'placeholder' => 22
                    ],
                    'required' => false
                ]
            )
        ;
    }
}