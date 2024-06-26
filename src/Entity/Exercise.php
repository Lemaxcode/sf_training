<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'exercises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MuscleGroup $muscleGroup = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $exercisePicfile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMuscleGroup(): ?MuscleGroup
    {
        return $this->muscleGroup;
    }

    public function setMuscleGroup(?MuscleGroup $muscleGroup): static
    {
        $this->muscleGroup = $muscleGroup;

        return $this;
    }

    public function getExercisePicfile(): ?string
    {
        return $this->exercisePicfile;
    }

    public function setExercisePicfile(?string $exercisePicfile): static
    {
        $this->exercisePicfile = $exercisePicfile;

        return $this;
    }
}
