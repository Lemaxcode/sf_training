<?php

namespace App\Controller;

use App\Repository\ExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExerciseController extends AbstractController
{
    #[Route('/exercise', name: 'exercise_index')]
    public function index(ExerciseRepository $exerciseRepository): Response
    {

        $exercises = $exerciseRepository->findAll();
        return $this->render('exercise/index.html.twig', [
            'exercises' => $exercises,
        ]);
    }
}
