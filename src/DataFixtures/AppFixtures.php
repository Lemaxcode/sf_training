<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MuscleGroup;
use App\Entity\Exercise;

class AppFixtures extends Fixture
{
    private const MUSCLEGROUP = ["Chest", "Arm", "Shoulder", "Back", "Legs"];
    public function load(ObjectManager $manager): void
    {
        // définir le chemin vers le fichier json
        $filename = __DIR__ . "/exercise.json";
        // Charger le contenenu textuel (brut) de ce fichier : file_get_contents
        $content = file_get_contents($filename);
        // Parser(analyser) le contenu de ce fichier pour en interpréter le contenu json et en faire un tableau php associatif : json_decode
        $dataArray = json_decode($content, true);

        foreach ($dataArray as $dataGroup) {
            $groupName = $dataGroup["group"];
            $muscleGroup = new MuscleGroup();
            $muscleGroup->setName($groupName);

            $manager->persist($muscleGroup);

            // Boucle sur les exercices liés à ce groupe
            foreach ($dataGroup['exercises'] as $dataExercise) {
                $exercise = new Exercise();
                $exercise
                    ->setName($dataExercise['name'])
                    ->setDescription($dataExercise['description'])
                    ->setMuscleGroup($muscleGroup);

                    $manager->persist($exercise);
               
            }
        }

        // $muscleGroups = [];
        // foreach (self::MUSCLEGROUP as $muscleGroupName) {
        //     $muscleGroup = new MuscleGroup();
        //     $muscleGroup->setName($muscleGroupName);

        //     $manager->persist($muscleGroup);
        //     $muscleGroups[] = $muscleGroup;
        // }
        // $exercise = new Exercise();
        // $exercise->setName('json ???')
        //     ->setDescription('json ?');


        // $manager->persist($exercise);
        $manager->flush();

    }
}
