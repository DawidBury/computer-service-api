<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraints\CreateTaskConstraints;
use App\Service\TaskService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractBaseController
{
    public function create(Request $request, TaskService $taskService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateTaskConstraints::get()
        );

        $task = $taskService->createTask($data['priority'], $data['taskTypeId']);

        $serializedTask = $this->_serializer->normalize($task, 'array', [
            'groups' => 'task',
        ]);

        return new JsonResponse($serializedTask, JsonResponse::HTTP_CREATED);
    }

    public function list(TaskService $taskService): JsonResponse
    {
        $tasks = $taskService->getAllTasks();

        $serializedTasks = $this->_serializer->normalize($tasks, 'array', [
            'groups' => 'task',
        ]);

        return new JsonResponse($serializedTasks, JsonResponse::HTTP_OK);
    }
}
