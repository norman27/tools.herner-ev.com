<?php

namespace AppBundle\Form;

use AppBundle\Entity\JoomlaCategory;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PlayersForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $options['entity_manager'];

        /** @var JoomlaCategory[] $cats */
        $cats = $em->getRepository(JoomlaCategory::class)->findBy([
            'extension' => 'com_hockeymanager_team',
            'published' => 1
        ]);

        $categories = [];
        foreach ($cats as $cat) {
            $categories[$cat->title] = $cat->id;
        }

        $builder->add('id', ChoiceType::class, ['choices' => $categories])
            ->add('players', CollectionType::class, array(
                'attr' => ['class' => 'js-addable-list'],
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'entry_type' => IntegerType::class,
                'prototype' => true,
                'required' => false
            ))
            ->add('timer', IntegerType::class, [
                'empty_data' => '5',
                'required' => false,
                'attr' => [
                    'class' => 'js-data-help',
                    'data-help' => 'Anzahl Sekunden für Übergang, <code>default=5</code>.'
                ]
            ])
            ->add('idsuffix', TextType::class, [
                'empty_data' => '',
                'required' => false,
                'attr' => [
                    'class' => 'js-data-help',
                    'data-help' => 'Hier kann ein beliebiges Suffix für die ID vergeben werden, um diese Spielerlist von dem Effekt "Torschütze" auszuschließen.'
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Save']);
    }
}