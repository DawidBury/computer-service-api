<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="integer", length=32, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $address;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $subscribedToNewsletter;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $nip;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceRequest", mappedBy="customerId")
     */
    private $serviceRequests;

    public function getId(): ?int
    {
        return $this->id;
    }
}
