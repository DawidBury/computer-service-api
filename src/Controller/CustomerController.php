<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraints\CreateCustomerConstraints;
use App\Service\CustomerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends AbstractBaseController
{
    public function create(Request $request, CustomerService $customerService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateCustomerConstraints::get()
        );

        $customer = $customerService->createCustomer(
            $data['userId'],
            $data['firstName'],
            $data['lastName'],
            $data['birthday'] ?? null,
            $data['gender'] ?? null,
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['subscribedToNewsletter'] ?? false,
            $data['nip'] ?? null
        );

        $serializedCustomer = $this->_serializer->normalize($customer, 'array', [
            'groups' => 'customer',
        ]);

        return new JsonResponse($serializedCustomer, JsonResponse::HTTP_CREATED);
    }
}
