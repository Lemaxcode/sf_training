<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MuscleGroup;
use App\Entity\Exercise;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const MUSCLEGROUP = ["Chest", "Arm", "Shoulder", "Back", "Legs"];
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    public function load(ObjectManager $manager): void
    {
        // définir le chemin vers le fichier json
        $filename = __DIR__ . "/exercise.json";
        // Charger le contenenu textuel (brut) de ce fichier : file_get_contents
        $content = file_get_contents($filename);
        // Parser(analyser) le contenu de ce fichier pour en interpréter le contenu json et en faire un tableau php associatif : json_decode
        $dataArray = json_decode($content, true);

        // parcours les élements du tableau $dataArray ou chaque élément est un groupe
        foreach ($dataArray as $dataGroup) {
            // récupere le nom du groupe musculaire 
            $groupName = $dataGroup["group"];
            //créer une nouvelle instance de la classe MuscleGroup
            $muscleGroup = new MuscleGroup();
            // défini le nom du groupe en utilisant le nom du groupe récupéré dans $groupname
            $muscleGroup->setName($groupName);

            $manager->persist($muscleGroup);

            // Boucle sur les exercices liés à ce groupe
            foreach ($dataGroup['exercises'] as $dataExercise) {
                // créer une nouvelle instance de la classe Exercise  
                $exercise = new Exercise();

                $exercise
                    //définit le nom de l'exercice 
                    ->setName($dataExercise['name'])
                    // définit la description de l'exercice
                    ->setDescription($dataExercise['description'])
                    // associe le groupe avec l'exercice
                    ->setMuscleGroup($muscleGroup);

                $manager->persist($exercise);

            }
        }

        $user = new User();
        $user->setEmail('user@max.net')
            ->setPassword($this->hasher->hashPassword($user, 'max'));
        $manager->persist($user);

        $admin = new User();
        $admin
            ->setEmail('admin@admin.com')
            ->setPassword($this->hasher->hashPassword($admin, 'admin'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        $manager->flush();

    }
}
