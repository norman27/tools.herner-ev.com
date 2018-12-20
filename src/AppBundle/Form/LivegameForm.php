<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Club;
use AppBundle\Entity\JoomlaBanner;
use Doctrine\ORM\EntityManager;

class LivegameForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var EntityManager $em */
        $em = $options['entity_manager'];

        $clubs = $this->getClubs($em);
        $banners = $this->getBanners($em);

        $builder->add('hometeam', ChoiceType::class, ['choices' => $clubs])
            ->add('homescore', IntegerType::class)
            ->add('awayteam', ChoiceType::class, ['choices' => $clubs])
            ->add('awayscore', IntegerType::class)
            ->add('goals', CollectionType::class, array(
                'attr' => ['class' => 'js-addable-list'],
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'entry_type' => TextType::class,
                'prototype' => true,
                'required' => false
            ))
            ->add('sponsoren', ChoiceType::class, [
                'multiple' => true,
                'required' => false,
                'choices' => $banners
            ])
            ->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }

    /**
     * @param EntityManager $em
     * @return Club[]
     */
    private function getClubs(EntityManager $em) {
        /** @var Club[] $clubs */
        $clubs = $em->getRepository(Club::class)->findBy(['state' => 1]);

        $clubChoices = [];
        foreach ($clubs as $club) {
            $clubChoices[$club->name] = $club->id;
        }
        ksort($clubChoices);

        return $clubChoices;
    }

    /**
     * @param EntityManager $em
     * @return JoomlaBanner[]
     */
    private function getBanners(EntityManager $em) {
        /** @var Club[] $banners */
        $banners = $em->getRepository(JoomlaBanner::class)->findBy(['state' => 1]);

        $bannerChoices = [];
        foreach ($banners as $banner) {
            $bannerChoices[$banner->name] = $banner->params["imageurl"];
        }
        ksort($bannerChoices);

        return $bannerChoices;
    }
}