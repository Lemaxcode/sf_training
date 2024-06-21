<?php

namespace App\Controller;

use App\Entity\Workout;
use App\Form\WorkoutType;
use App\Repository\WorkoutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/workout/controller/crud')]
class WorkoutControllerCrudController extends AbstractController
{
    #[Route('/', name: 'app_workout_controller_crud_index', methods: ['GET'])]
    public function index(WorkoutRepository $workoutRepository): Response
    {
        return $this->render('workout_controller_crud/index.html.twig', [
            'workouts' => $workoutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_workout_controller_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $workout = new Workout();
        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workout->setCreatedAt(new \DateTime());
            $entityManager->persist($workout);
            $entityManager->flush();
           
            return $this->redirectToRoute('app_workout_controller_crud_show', ['id' => $workout->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workout_controller_crud/new.html.twig', [
            'workout' => $workout,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workout_controller_crud_show', methods: ['GET'])]
    public function show(Workout $workout): Response
    {
        return $this->render('workout_controller_crud/show.html.twig', [
            'workout' => $workout,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_workout_controller_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workout $workout, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_workout_controller_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workout_controller_crud/edit.html.twig', [
            'workout' => $workout,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workout_controller_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Workout $workout, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workout->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($workout);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_workout_controller_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
