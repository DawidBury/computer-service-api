<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    public function register(Request $request, UserService $userService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $userService->createUser($data['username'], $data['password']);

        return new JsonResponse($user, JsonResponse::HTTP_CREATED);
    }
}
