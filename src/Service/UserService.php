<?php

declare(strict_types=1);

namespace App\Service;

use App\Constants\RoleConstants;
use App\Constants\UserConstants;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $userRepository;

    private $em;

    private $encoder;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function createUser(string $email, string $password): User
    {
        $user = new User($email);
        $user->setPassword($this->encoder->encodePassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function getUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function createBasicUsers(): void
    {
        $user = new User(UserConstants::EMAIL_ADMIN);
        $user->setPassword($this->encoder->encodePassword($user, 'qwerty123!'));
        $user->setRoles([RoleConstants::ADMIN]);
        $this->em->persist($user);
        $this->em->flush();

        $user = new User(UserConstants::EMAIL_USER);
        $user->setPassword($this->encoder->encodePassword($user, 'qwerty123!'));
        $user->setRoles([RoleConstants::USER]);
        $this->em->persist($user);
        $this->em->flush();
    }
}
