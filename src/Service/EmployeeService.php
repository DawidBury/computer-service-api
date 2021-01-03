<?php

declare(strict_types=1);

namespace App\Service;

use App\Constants\RoleConstants;
use App\Entity\Employee;
use App\Entity\User;
use App\Exception\NotFoundException;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmployeeService
{
    private $em;
    private $employeeRepository;
    private $encoder;

    public function __construct(EmployeeRepository $employeeRepository, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->employeeRepository = $employeeRepository;
        $this->encoder = $encoder;
    }

    public function createEmployee(string $email, string $firstName, string $lastName, string $businessNumber): Employee
    {
        $user = new User(
            $email
        );
        $user->setPassword($this->encoder->encodePassword($user, 'Testowe123!'));
        $user->setEnabled(true);
        $user->setRoles([RoleConstants::EMPLOYEE]);
        $user->setConfirmationToken(null);

        $employee = new Employee(
            $firstName,
            $lastName,
            $businessNumber,
            $user
        );

        $this->em->persist($user);
        $this->em->persist($employee);
        $this->em->flush();

        return $employee;
    }
}
