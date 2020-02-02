<?php

namespace App\Admin\Screen\Edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SixForm extends AbstractType
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
                'team',
                ChoiceType::class,
                [
                    'choices' => $this->getClubs(),
                    'placeholder' => '---'
                ]
            )
        ;

        for ($i = 1; $i <= 6; $i++)
        {
            $builder
                ->add(
                    'number_' . $i,
                    IntegerType::class,
                    [
                        'attr' => [
                            'placeholder' => 'Nr.'
                        ]
                    ]
                )
                ->add(
                    'name_' . $i,
                    TextType::class,
                    [
                        'attr' => [
                            'placeholder' => 'Name'
                        ]
                    ]
                )
                ->add(
                    'firstname_' . $i,
                    TextType::class,
                    [
                        'attr' => [
                            'placeholder' => 'Vorname'
                        ]
                    ]
                )
            ;
        }
    }
}