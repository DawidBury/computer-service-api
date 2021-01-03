<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TaskType;
use App\Repository\TaskTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskTypeService
{
    private $taskTypeRepository;
    private $em;

    public function __construct(TaskTypeRepository $taskTypeRepository, EntityManagerInterface $em)
    {
        $this->taskTypeRepository = $taskTypeRepository;
        $this->em = $em;
    }

    public function createTaskType(string $name, int $cost): TaskType
    {
        $taskType = new TaskType(
            $name,
            $cost
        );

        $this->em->persist($taskType);
        $this->em->flush();

        return $taskType;
    }

    public function getAllTaskTypes(): array
    {
        return $this->taskTypeRepository->findAll();
    }
}
