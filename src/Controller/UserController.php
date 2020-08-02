<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraints\CreateUserConstraints;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractBaseController
{
    public function register(Request $request, UserService $userService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateUserConstraints::get()
        );

        $user = $userService->createUser($data['username'], $data['password']);

        return new JsonResponse($user, JsonResponse::HTTP_CREATED);
    }

    public function getUsers(UserService $userService)
    {
        return new JsonResponse($userService->getUsers(), JsonResponse::HTTP_OK);
    }
}
