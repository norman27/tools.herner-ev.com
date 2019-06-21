<?php

namespace AppBundle\Form;

use AppBundle\Entity\JoomlaCategory;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TableForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $options['entity_manager'];

        /** @var JoomlaCategory[] $cats */
        $cats = $em->getRepository(JoomlaCategory::class)->findBy([
            'extension' => 'com_hockeymanager_table',
            'published' => 1,
            'level' => 2
        ]);

        $categories = [];
        foreach ($cats as $cat) {
            $categories[$cat->title] = $cat->id;
        }

        $builder->add('caption', TextType::class, ['required' => false])
            ->add('id', ChoiceType::class, ['choices' => $categories])
            ->add('font', IntegerType::class, [
                'attr' => ['placeholder' => 22],
                'required' => false
            ])
            ->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }
}