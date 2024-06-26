<?php

namespace App\Form;

use App\Entity\Exercise;
use App\Entity\MuscleGroup;
use App\Entity\Workout;
use App\Entity\WorkoutExercise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkoutExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('series')
            ->add('repetition')
            ->add('weight')
            ->add('exercises', EntityType::class, [
                'class' => Exercise::class,
                'choice_label' => 'name',
            ])
          
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkoutExercise::class,
        ]);
    }
}
