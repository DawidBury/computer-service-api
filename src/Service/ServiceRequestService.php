<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Customer;
use App\Entity\ServiceRequest;
use App\Exception\NotFoundException;
use App\Repository\ServiceRequestRepository;
use Doctrine\ORM\EntityManagerInterface;

class ServiceRequestService
{
    private $serviceRequestRepository;
    private $em;

    public function __construct(ServiceRequestRepository $serviceRequestRepository, EntityManagerInterface $em)
    {
        $this->serviceRequestRepository = $serviceRequestRepository;
        $this->em = $em;
    }

    public function createServiceRequest(string $subject, string $description, int $customerId)
    {
        $customer = $this->em->getRepository(Customer::class)->find($customerId);

        if (!$customer) {
            throw new NotFoundException($customerId);
        }

        $serviceRequest = new ServiceRequest(
            $subject,
            $description,
            $customer
        );

        $this->em->persist($serviceRequest);
        $this->em->flush();

        return $serviceRequest;
    }
}
