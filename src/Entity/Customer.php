<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"customer"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"customer"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"customer"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"customer"})
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"customer"})
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     *
     * @Groups({"customer"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     *
     * @Groups({"customer"})
     */
    private $address;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     *
     * @Groups({"customer"})
     */
    private $subscribedToNewsletter;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     *
     * @Groups({"customer"})
     */
    private $nip;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceRequest", mappedBy="customer")
     */
    private $serviceRequests;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="customer")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @Groups({"customer"})
     */
    private $user;

    public function __construct(
        User $user,
        string $firstName,
        string $lastName,
        ?\DateTime $birthday = null,
        ?string $gender = null,
        ?string $phone = null,
        ?string $address = null,
        ?bool $subscribedToNewsletter = false,
        ?string $nip = null
    ) {
        $this->user = $user;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->address = $address;
        $this->subscribedToNewsletter = $subscribedToNewsletter;
        $this->nip = $nip;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTime $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): Customer
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): Customer
    {
        $this->address = $address;

        return $this;
    }

    public function isSubscribedToNewsletter(): bool
    {
        return $this->subscribedToNewsletter;
    }

    public function setSubscribedToNewsletter(bool $subscribedToNewsletter): self
    {
        $this->subscribedToNewsletter = $subscribedToNewsletter;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(?string $nip): self
    {
        $this->nip = $nip;

        return $this;
    }

    public function getServiceRequests(): ArrayCollection
    {
        return $this->serviceRequests;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
