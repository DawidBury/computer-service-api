<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\TaskType;
use Doctrine\Persistence\ObjectManager;

class TaskTypeFixtures extends AppFixtures
{
    private $name = [
        'Wymiana pasty termoprzewodzącej',
        'Wyczyszczenie komputera',
        'Budowa komputera',
        'Inne',
    ];

    protected function loadData(ObjectManager $manager)
    {
        for ($i = 0; $i < 3; ++$i) {
            $name = $this->faker->randomElement($this->name);
            unset($this->name[$name]);
            $entity = new TaskType(
                $name,
                $this->faker->numberBetween(20, 1000)
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
