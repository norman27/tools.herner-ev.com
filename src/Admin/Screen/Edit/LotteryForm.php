<?php

namespace App\Admin\Screen\Edit;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;

class LotteryForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'puck1',
                IntegerType::class
            )
            ->add(
                'puck2',
                IntegerType::class
            )
            ->add(
                'puck3',
                IntegerType::class
            )
            ->add(
                'jersey',
                IntegerType::class
            )
            ->add(
                'pokal',
                IntegerType::class
            )
        ;
    }
}