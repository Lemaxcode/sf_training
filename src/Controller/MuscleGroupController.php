<?php

namespace App\Controller;

use App\Entity\MuscleGroup;
use App\Repository\MuscleGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MuscleGroupController extends AbstractController
{
    #[Route('/muscle/group', name: 'muscle_group')]
    public function index(MuscleGroupRepository $muscleGroupRepository): Response
    {
        $muscles = $muscleGroupRepository->findAll();
        
        return $this->render('muscle_group/index.html.twig', [
            'muscles' => $muscles,
            
        ]);
    }
}
