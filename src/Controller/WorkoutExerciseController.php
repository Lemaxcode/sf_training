<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WorkoutExerciseController extends AbstractController
{
    #[Route('/workout/exercise', name: 'app_workout_exercise')]
    public function index(): Response
    {
        return $this->render('workout_exercise/index.html.twig', [
            'controller_name' => 'WorkoutExerciseController',
        ]);
    }
}
