<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraints\CreateUserConstraints;
use App\Service\UserService;
use App\Service\ValidatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    public function register(Request $request, UserService $userService, ValidatorService $validatorService): JsonResponse
    {
        $validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateUserConstraints::get()
        );

        $user = $userService->createUser($data['username'], $data['password']);

        return new JsonResponse($user, JsonResponse::HTTP_CREATED);
    }
}
