<?php

namespace AppBundle\Admin\Screen\Edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ScheduleForm extends AbstractType
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
                'title',
                TextType::class
            )
            ->add(
                'id',
                ChoiceType::class,
                [
                    'choices' => $this->getCategories('com_hockeymanager_schedule')
                ]
            )
        ;
    }
}