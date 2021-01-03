<?php

declare(strict_types=1);

namespace App\Constraints;

use App\Constraints\CustomConstraints\UniqueField;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateEmployeeConstraints
{
    public static function get(): Collection
    {
        return new Collection([
            'allowExtraFields' => true,
            'fields' => [
                'email' => [
                    new NotBlank(),
                    new Type('string'),
                    new Email(),
                    new UniqueField(['entity' => User::class, 'field' => 'email']),
                ],
                'firstName' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['max' => 64]),
                ],
                'lastName' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['max' => 64]),
                ],
                'businessNumber' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['min' => 6, 'max' => 12]),
                ],
            ],
        ]);
    }
}
