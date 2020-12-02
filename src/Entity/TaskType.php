<?php

namespace App\Entity;

use App\Repository\TaskTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskTypeRepository::class)
 */
class TaskType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="taskType")
     */
    private $tasks;

    public function getId(): ?int
    {
        return $this->id;
    }
}
