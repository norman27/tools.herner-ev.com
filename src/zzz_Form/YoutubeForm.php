<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class YoutubeForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('video', TextType::class, [
                'label' => 'Youtube URL',
                'attr' => [
                    'class' => 'js-data-help',
                    'data-help' => 'Aus der URL <code>https://www.youtube.com/<strong>watch?v=</strong>-6FInwsmoQ8</code> muss <code>https://www.youtube.com/<strong>embed/</strong>-6FInwsmoQ8</code> gemacht werden'
                ]
            ])
            ->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }
}