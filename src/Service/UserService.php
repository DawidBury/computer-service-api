<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(string $email, string $password)
    {
        return $this->userRepository->createUser($email, $password);
    }
}
