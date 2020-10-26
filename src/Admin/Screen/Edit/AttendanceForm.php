<?php declare(strict_types=1);

namespace App\Admin\Screen\Edit;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;

class AttendanceForm extends AbstractType
{
    use JoomlaHelperTrait;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'attendance',
                IntegerType::class
            )
            ->add(
                'sponsor',
                ChoiceType::class,
                [
                    'required' => false,
                    'choices' => $this->getBanners(),
                    'attr' => ['size' => 10]
                ]
            )
        ;
    }
}