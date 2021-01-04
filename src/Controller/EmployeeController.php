<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraints\CreateEmployeeConstraints;
use App\Service\EmployeeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController extends AbstractBaseController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request, EmployeeService $employeeService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateEmployeeConstraints::get()
        );

        $employee = $employeeService->createEmployee(
            $data['email'],
            $data['firstName'],
            $data['lastName'],
            $data['businessNumber']
        );

        $serializedEmployee = $this->_serializer->normalize($employee, 'array', [
            'groups' => 'employee',
        ]);

        return new JsonResponse($serializedEmployee, JsonResponse::HTTP_CREATED);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    public function list(EmployeeService $employeeService): JsonResponse
    {
        $employees = $employeeService->getAllEmployees();

        $serializedEmployees = $this->_serializer->normalize($employees, 'array', [
            'groups' => 'employee',
        ]);

        return new JsonResponse($serializedEmployees, JsonResponse::HTTP_OK);
    }
}
