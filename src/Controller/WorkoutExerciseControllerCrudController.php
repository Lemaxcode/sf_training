<?php

namespace App\Controller;

use App\Entity\Workout;
use App\Entity\WorkoutExercise;
use App\Form\WorkoutExerciseType;
use App\Repository\WorkoutExerciseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/workout/exercise/controller/crud')]
class WorkoutExerciseControllerCrudController extends AbstractController
{
    #[Route('/', name: 'app_workout_exercise_controller_crud_index', methods: ['GET'])]
    public function index(WorkoutExerciseRepository $workoutExerciseRepository): Response
    {
        return $this->render('workout_exercise_controller_crud/index.html.twig', [
            'workout_exercises' => $workoutExerciseRepository->findAll(),
        ]);
    }

    #[Route('/workout/{id}/exercise/new', name: 'app_workout_exercise_controller_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $workout = $entityManager->getRepository(Workout::class)->findOneBy(['id' => $id]);

        $workoutExercise = new WorkoutExercise();
        $form = $this->createForm(WorkoutExerciseType::class, $workoutExercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workoutExercise->setWorkouts($workout);
            $entityManager->persist($workoutExercise);
            $entityManager->flush();

            return $this->redirectToRoute('app_workout_controller_crud_show', ['id' => $workout->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workout_exercise_controller_crud/new.html.twig', [
            'workout_exercise' => $workoutExercise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workout_exercise_controller_crud_show', methods: ['GET'])]
    public function show(WorkoutExercise $workoutExercise, EntityManagerInterface $entityManager, int $id): Response
    {

        //trouver la liste des exercices par rapport a un workout
        $workout = $entityManager->getRepository(Workout::class)->findOneBy(['id' => $id]);

        $workoutsExercises = $entityManager->getRepository(WorkoutExercise::class)->findBy(['id' => $id]);


        return $this->render('workout_exercise_controller_crud/show.html.twig', [
            'workout_exercise' => $workoutsExercises,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_workout_exercise_controller_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WorkoutExercise $workoutExercise, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WorkoutExerciseType::class, $workoutExercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_workout_exercise_controller_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workout_exercise_controller_crud/edit.html.twig', [
            'workout_exercise' => $workoutExercise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workout_exercise_controller_crud_delete', methods: ['POST'])]
    public function delete(Request $request, WorkoutExercise $workoutExercise, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $workoutExercise->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($workoutExercise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_workout_exercise_controller_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
