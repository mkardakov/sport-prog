<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\UserExercise;
use App\Repository\ProgramRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserExerciseModalType extends AbstractType
{

    private $requestStack;

    private $programRepo;

    public function __construct(RequestStack $requestStack, ProgramRepository $programRepo)
    {
        $this->requestStack = $requestStack;
        $this->programRepo = $programRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('program', HiddenType::class)
            ->add('weight')
            ->add('repetition')
            ->add('setTotal')
            ->add('exercise')
        ;
        $builder->get('program')
                ->addModelTransformer(new CallbackTransformer(function() {
                    return $this->getProgramId();
                }, function($id) {
                    return $this->programRepo->find($id);
                }));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserExercise::class,
        ]);
    }

    private function getProgramId()
    {
        return $this
            ->requestStack
            ->getCurrentRequest()
            ->attributes
            ->get('id');
    }
}
