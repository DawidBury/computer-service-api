<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constants\RoleConstants;
use App\Constraints\CreateServiceRequestConstraints;
use App\Entity\User;
use App\Service\ServiceRequestService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ServiceRequestController extends AbstractBaseController
{
    public function create(Request $request, ServiceRequestService $serviceRequestService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateServiceRequestConstraints::get()
        );

        $serviceRequest = $serviceRequestService->createServiceRequest(
            $data['subject'],
            $data['description'],
            $data['customerId']
        );

        $serializedServiceRequest = $this->_serializer->normalize($serviceRequest, 'array', [
            'groups' => 'service-request:create',
        ]);

        return new JsonResponse($serializedServiceRequest, JsonResponse::HTTP_CREATED);
    }

    public function list(ServiceRequestService $serviceRequestService): JsonResponse
    {
        $this->denyAccessUnlessGranted(RoleConstants::EMPLOYEE);
        $serviceRequests = $serviceRequestService->getAllServiceRequests();

        $serializedRequests = $this->_serializer->normalize($serviceRequests, 'array', [
            'groups' => 'service-request:list',
        ]);

        return new JsonResponse($serializedRequests, JsonResponse::HTTP_OK);
    }

    public function listByUser(ServiceRequestService $serviceRequestService): JsonResponse
    {
        $customerId = $this->getUser()->getCutomer()->getId();
        $serviceRequests = $serviceRequestService->getServiceRequestByUser($customerId);

        $serializedRequests = $this->_serializer->normalize($serviceRequests, 'array', [
            'groups' => 'service-request:list',
        ]);

        return new JsonResponse($serializedRequests, JsonResponse::HTTP_OK);
    }
}
