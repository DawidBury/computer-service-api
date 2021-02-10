<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ServiceRequestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ServiceRequestRepository::class)
 */
class ServiceRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"service-request:create"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"service-request:create", "service-request:list"})
     */
    private $subject;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"service-request:create", "service-request:list"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"service-request:list"})
     */
    private $deadline;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"service-request:list"})
     */
    private $proposedDeliveryTime;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Task", mappedBy="serviceRequest")
     *
     * @Groups({"service-request:list"})
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="serviceRequests")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *
     * @Groups({"service-request:create"})
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="serviceRequests")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    public function __construct(?string $subject = '', ?string $description = '', ?Customer $customer = null)
    {
        $this->subject = $subject;
        $this->description = $description;
        $this->customer = $customer;
    }

    public function __toString()
    {
        return (string) $this->getId().' | '.$this->getSubject();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDeadline(): ?\DateTime
    {
        return $this->deadline;
    }

    public function getProposedDeliveryTime(): ?\DateTime
    {
        return $this->proposedDeliveryTime;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setSubject(?string $subject): ServiceRequest
    {
        $this->subject = $subject;

        return $this;
    }

    public function setType($type): ServiceRequest
    {
        $this->type = $type;

        return $this;
    }

    public function setDescription(?string $description): ServiceRequest
    {
        $this->description = $description;

        return $this;
    }

    public function setDeadline($deadline): ServiceRequest
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function setProposedDeliveryTime($proposedDeliveryTime): ServiceRequest
    {
        $this->proposedDeliveryTime = $proposedDeliveryTime;

        return $this;
    }

    public function setTask($task): ServiceRequest
    {
        $this->task = $task;

        return $this;
    }

    public function setCustomer(?Customer $customer): ServiceRequest
    {
        $this->customer = $customer;

        return $this;
    }

    public function setEmployee($employee): ServiceRequest
    {
        $this->employee = $employee;

        return $this;
    }
}
