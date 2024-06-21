<?php

namespace App\Entity;

use App\Repository\WorkoutExerciseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutExerciseRepository::class)]
class WorkoutExercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $series = null;

    #[ORM\Column]
    private ?int $repetition = null;

    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercises = null;

    #[ORM\ManyToOne(inversedBy: 'workoutExercises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Workout $workouts = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeries(): ?int
    {
        return $this->series;
    }

    public function setSeries(int $series): static
    {
        $this->series = $series;

        return $this;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(int $repetition): static
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getExercises(): ?Exercise
    {
        return $this->exercises;
    }

    public function setExercises(?Exercise $exercises): static
    {
        $this->exercises = $exercises;

        return $this;
    }

    public function getWorkouts(): ?Workout
    {
        return $this->workouts;
    }

    public function setWorkouts(?Workout $workouts): static
    {
        $this->workouts = $workouts;

        return $this;
    }
}
