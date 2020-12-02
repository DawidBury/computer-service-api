<?php

namespace App\Entity;

use App\Repository\ServiceRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRequestRepository::class)
 */
class ServiceRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $deadline;

    /**
     * @ORM\Column(type="datetime")
     */
    private $proposedDeliveryTime;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Task", mappedBy="serviceRequest")
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="serviceRequests")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customerId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="serviceRequests")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employeeId;

    public function getId(): ?int
    {
        return $this->id;
    }
}
