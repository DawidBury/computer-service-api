<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TaskTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TaskTypeRepository::class)
 */
class TaskType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"task-type", "task"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"task-type"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"task-type"})
     */
    private $cost;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="taskType")
     */
    private $tasks;

    public function __construct(string $name, int $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getTasks(): Collection
    {
        return $this->tasks;
    }
}
