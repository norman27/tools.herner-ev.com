<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class AttendanceForm extends EntityManagerAwareForm {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $finder = new Finder();

        /** @var SplFileInfo[] $foundFiles */
        $foundFiles = $finder->files()->in(realpath(__DIR__ . '/../../../web/media'));

        $files = [];
        foreach ($foundFiles as $file) {
            if ($this->isValidExtension($file)) {
                $files[$file->getFilename()] = $file->getFilename();
            }
        }

        $builder->add('attendance', IntegerType::class)
            ->add('sponsor', ChoiceType::class, ['choices' => $files])
            ->add('save', SubmitType::class, ['label' => 'Save']);
    }

    /**
     * @param SplFileInfo $file
     * @return boolean
     */
    private function isValidExtension(SplFileInfo $file) {
        return in_array(strtolower($file->getExtension()), ['jpg', 'png']);
    }
}