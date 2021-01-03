<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskType", inversedBy="tasks")
     * @ORM\JoinColumn(name="task_type_id", referencedColumnName="id")
     */
    private $taskType;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ServiceRequest", inversedBy="task")
     * @ORM\JoinColumn(name="service_request_id", referencedColumnName="id")
     */
    private $serviceRequest;

    public function __construct(int $priority, TaskType $taskType)
    {
        $this->priority = $priority;
        $this->taskType = $taskType;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getTaskType(): TaskType
    {
        return $this->taskType;
    }

    public function getServiceRequest(): ServiceRequest
    {
        return $this->serviceRequest;
    }
}
