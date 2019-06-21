<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Hockey\Club;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SixForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var EntityManager $em */
        $em = $options['entity_manager'];
        $clubs = $this->getClubs($em);

        $builder->add('team', ChoiceType::class, ['choices' => $clubs, 'placeholder' => '---']);

        for ($i = 1; $i <= 6; $i++) {
            $builder->add('number_' . $i, IntegerType::class, ['attr' => ['placeholder' => 'Nr.']])
                ->add('name_' . $i, TextType::class, ['attr' => ['placeholder' => 'Name']])
                ->add('firstname_' . $i, TextType::class, ['attr' => ['placeholder' => 'Vorname']]);
        }

        $builder->add('save', SubmitType::class, ['label' => 'Save']);
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
}