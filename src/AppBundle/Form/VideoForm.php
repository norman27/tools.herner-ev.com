<?php

namespace AppBundle\Form;

use AppBundle\Repository\FilesRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VideoForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $files = new FilesRepository();
        $videos = array_combine(array_keys($files->getAllVideos()), array_keys($files->getAllVideos()));

        $builder->add('video', ChoiceType::class, ['choices' => $videos])
            ->add('overlay', TextType::class, [
                'empty_data' => '',
                'required' => false,
                'attr' => [
                    'class' => 'js-data-help',
                    'data-help' => 'Falls benutzt wird der Text über das Video gelegt.'
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
        ;
    }
}