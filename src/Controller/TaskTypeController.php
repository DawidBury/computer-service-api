<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraints\CreateTaskTypeConstraints;
use App\Service\TaskTypeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class TaskTypeController extends AbstractBaseController
{
    public function create(Request $request, TaskTypeService $taskTypeService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateTaskTypeConstraints::get()
        );

        $taskType = $taskTypeService->createTaskType($data['name'], $data['cost']);

        $serializedTaskType = $this->_serializer->normalize($taskType, 'array', [
            'groups' => 'task-type',
        ]);

        return new JsonResponse($serializedTaskType, JsonResponse::HTTP_CREATED);
    }

    public function list(TaskTypeService $taskTypeService): JsonResponse
    {
        $taskTypes = $taskTypeService->getAllTaskTypes();

        $serializedTaskTypes = $this->_serializer->normalize($taskTypes, 'array', [
            'groups' => 'task-type',
        ]);

        return new JsonResponse($serializedTaskTypes, JsonResponse::HTTP_OK);
    }
}
