<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WorkoutController extends AbstractController
{
    #[Route('/workout', name: 'workout_index')]
    public function index(): Response
    {
        // $user= $this->getUser();
        // $workouts = $user->getWorkouts();
        // return $this->render('workout/index.html.twig', [
        //     'workouts'=> $workouts
        // ]);
        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('Vous devez être connecté pour voir cette page.');
        }

        // Supposons que la méthode getWorkouts() existe dans votre entité User
        $workouts = $user->getWorkouts();

        return $this->render('workout/index.html.twig', [
            'workouts' => $workouts,
        ]);
    }
    }

