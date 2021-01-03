<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Task;
use App\Entity\TaskType;
use App\Exception\NotFoundException;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    private $em;
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->taskRepository = $taskRepository;
    }

    public function createTask(int $priority, int $taskTypeId): Task
    {
        $taskType = $this->em->getRepository(TaskType::class)->find($taskTypeId);

        if ($taskType === null) {
            throw new NotFoundException($taskTypeId);
        }

        $task = new Task(
            $priority,
            $taskType
        );

        $this->em->persist($task);
        $this->em->flush();

        return $task;
    }
}
