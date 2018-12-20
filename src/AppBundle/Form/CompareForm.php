<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Club;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompareForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var EntityManager $em */
        $em = $options['entity_manager'];
        $clubs = $this->getClubs($em);

        $builder->add('hometeam', ChoiceType::class, ['choices' => $clubs, 'placeholder' => '---'])
            ->add('awayteam', ChoiceType::class, ['choices' => $clubs, 'placeholder' => '---'])
            ->add('homeplatz', IntegerType::class)
            ->add('awayplatz', IntegerType::class)
            ->add('homepunkte', IntegerType::class)
            ->add('awaypunkte', IntegerType::class)
            ->add('hometore', IntegerType::class)
            ->add('homegegentore', IntegerType::class)
            ->add('awaytore', IntegerType::class)
            ->add('awaygegentore', IntegerType::class)
            ->add('homescorer', TextType::class)
            ->add('homescorerpunkte', IntegerType::class)
            ->add('awayscorer', TextType::class)
            ->add('awayscorerpunkte', IntegerType::class)
            ->add('homegefahr', TextType::class)
            ->add('homegefahrpunkte', IntegerType::class)
            ->add('awaygefahr', TextType::class)
            ->add('awaygefahrpunkte', IntegerType::class)
            ->add('homebadboy', TextType::class)
            ->add('homebadboypunkte', IntegerType::class)
            ->add('awaybadboy', TextType::class)
            ->add('awaybadboypunkte', IntegerType::class);

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