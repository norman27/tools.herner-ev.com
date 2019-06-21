<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Hockey\Club;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OthergamesForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var EntityManager $em */
        $em = $options['entity_manager'];

        $clubs = $this->getClubs($em);

        for ($i = 1; $i <= 8; $i++) {
            $builder->add('home_' . $i, ChoiceType::class, ['choices' => $clubs, 'placeholder' => '---', 'required' => false])
                ->add('scorehome_' . $i, IntegerType::class, ['required' => false])
                ->add('scoreaway_' . $i, IntegerType::class, ['required' => false])
                ->add('away_' . $i, ChoiceType::class, ['choices' => $clubs, 'placeholder' => '---', 'required' => false])
                ->add('finished_' . $i, CheckboxType::class, ['label' => 'beendet', 'required' => false]);
        }

        $builder->add('save', SubmitType::class, array('label' => 'Save'));
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