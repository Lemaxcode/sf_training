<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WorkoutController extends AbstractController
{
    #[Route('/workout', name: 'workout_index')]
    public function index(): Response
    {
        $user= $this->getUser();
        $workouts = $user->getWorkouts();
        return $this->render('workout/index.html.twig', [
            'workouts'=> $workouts
        ]);
    }
}
