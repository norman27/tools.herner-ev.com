<?php

namespace AppBundle\Admin\Screen\Edit;

use AppBundle\Entity\Joomla\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ScheduleForm extends AbstractType
{
    use ManagerRegistryAwareTrait;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'caption',
                TextType::class, ['required' => false]
            )
            ->add(
                'id',
                ChoiceType::class,
                [
                    'choices' => $this->getCategories()
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Save',
                    'attr' => [
                        'class' => 'btn btn-primary mt-3'
                    ]
                ]
            )
        ;
    }

    /**
     * @return array
     */
    private function getCategories(): array
    {
        /** @var Category[] $cats */
        $joomlaCategories = $this->managerRegistry->getRepository(Category::class)->findBy([
            'extension' => 'com_hockeymanager_schedule',
            'published' => 1,
            'level' => 2
        ]);

        $categories = [];
        foreach ($joomlaCategories as $joomlaCategory)
        {
            $categories[$joomlaCategory->title] = $joomlaCategory->id;
        }

        return $categories;
    }
}