<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Customer;
use App\Entity\User;
use App\Exception\NotFoundException;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CustomerService
{
    private $customerRepository;
    private $em;

    public function __construct(CustomerRepository $customerRepository, EntityManagerInterface $em)
    {
        $this->customerRepository = $customerRepository;
        $this->em = $em;
    }

    public function createCustomer(
        int $userId,
        string $firstName,
        string $lastName,
        ?string $birthday,
        ?string $gender,
        ?string $phone,
        ?string $address,
        ?bool $subscribedToNewsletter,
        ?string $nip
    ): Customer {
        $birthday = \DateTime::createFromFormat('d-m-Y H:i', $birthday);

        $user = $this->em->getRepository(User::class)->find($userId);

        if (!$user) {
            throw new NotFoundException($userId);
        }

        $customer = new Customer(
            $user,
            $firstName,
            $lastName,
            $birthday,
            $gender,
            $phone,
            $address,
            $subscribedToNewsletter,
            $nip
        );

        $this->em->persist($customer);
        $this->em->flush();

        return $customer;
    }
}
