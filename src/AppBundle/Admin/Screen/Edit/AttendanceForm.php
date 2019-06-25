<?php

namespace AppBundle\Admin\Screen\Edit;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use AppBundle\Screen\FilesRepository;

class AttendanceForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $repository = new FilesRepository();

        $builder
            ->add(
                'attendance',
                IntegerType::class
            )
            ->add(
                'sponsor',
                ChoiceType::class,
                [
                    'choices' => $repository->getAll()
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