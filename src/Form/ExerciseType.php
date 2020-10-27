<?php

namespace App\Form;

use App\Entity\Exercise;
use App\Entity\Muscle;
use App\Repository\MuscleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseType extends AbstractType
{

    private $repository;

    public function __construct(MuscleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'Легкий' => 1,
                    'Средний' => 2,
                    'Тяжелый' => 3,
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Базовое' => true,
                    'Изолированное' => false,
                ]
            ])
            ->add('muscles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
