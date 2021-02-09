<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"employee"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"employee"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"employee"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=12)
     *
     * @Groups({"employee"})
     */
    private $businessNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceRequest", mappedBy="employee")
     */
    private $serviceRequests;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="employee")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @Groups({"employee"})
     */
    private $user;

    public function __construct(?string $firstName = null, ?string $lastName = null, ?string $businessNumber = null, ?User $user = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->businessNumber = $businessNumber;
        $this->user = $user;
        $this->serviceRequests = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getFirstName().' '.$this->getLastName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getBusinessNumber(): string
    {
        return $this->businessNumber;
    }

    public function getServiceRequests(): ArrayCollection
    {
        return $this->serviceRequests;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setFirstName(?string $firstName): Employee
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(?string $lastName): Employee
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setBusinessNumber(?string $businessNumber): Employee
    {
        $this->businessNumber = $businessNumber;

        return $this;
    }

    public function setUser(?User $user): Employee
    {
        $this->user = $user;

        return $this;
    }
}
