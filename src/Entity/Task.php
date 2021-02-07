<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"task", "service-request:list"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"task"})
     */
    private $priority;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     *
     * @Groups({"service-request:list"})
     */
    private $inProgress = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskType", inversedBy="tasks")
     * @ORM\JoinColumn(name="task_type_id", referencedColumnName="id")
     *
     * @Groups({"task"})
     */
    private $taskType;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ServiceRequest", inversedBy="task")
     * @ORM\JoinColumn(name="service_request_id", referencedColumnName="id")
     */
    private $serviceRequest;

    public function __construct(?int $priority = null, ?TaskType $taskType = null)
    {
        $this->priority = $priority;
        $this->taskType = $taskType;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getTaskType(): ?TaskType
    {
        return $this->taskType;
    }

    public function getServiceRequest(): ?ServiceRequest
    {
        return $this->serviceRequest;
    }

    public function setServiceRequest(?ServiceRequest $serviceRequest): ServiceRequest
    {
        return $this->serviceRequest = $serviceRequest;
    }

    public function setPriority(?int $priority): Task
    {
        $this->priority = $priority;

        return $this;
    }

    public function setTaskType(?TaskType $taskType): Task
    {
        $this->taskType = $taskType;

        return $this;
    }

    public function getInProgress(): bool
    {
        return $this->inProgress;
    }

    public function setInProgress($inProgress): Task
    {
        $this->inProgress = $inProgress;

        return $this;
    }
}
