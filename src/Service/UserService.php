<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private $userRepository;

    private $em;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function createUser(string $email, string $password)
    {
        return $this->userRepository->createUser($email, $password);
    }

    public function getUsers()
    {
        return $this->em->getRepository(User::class)->findAll();
    }
}
