<?php

namespace App\Admin\Screen\Edit;

use Doctrine\ORM\EntityManager;
use App\Entity\Hockey\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OthergamesForm extends AbstractType
{
    use JoomlaHelperTrait;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $clubs = $this->getClubs();

        for ($i = 1; $i <= 8; $i++)
        {
            $builder
                ->add(
                    'home_' . $i,
                    ChoiceType::class,
                    [
                        'choices' => $clubs,
                        'placeholder' => '---',
                        'required' => false
                    ]
                )
                ->add(
                    'scorehome_' . $i,
                    IntegerType::class,
                    [
                        'required' => false
                    ]
                )
                ->add(
                    'scoreaway_' . $i,
                    IntegerType::class,
                    [
                        'required' => false
                    ]
                )
                ->add(
                    'away_' . $i,
                    ChoiceType::class,
                    [
                        'choices' => $clubs,
                        'placeholder' => '---',
                        'required' => false
                    ]
                )
                ->add(
                    'finished_' . $i,
                    CheckboxType::class,
                    [
                        'label' => 'beendet',
                        'required' => false
                    ]
                )
            ;
        }
    }
}