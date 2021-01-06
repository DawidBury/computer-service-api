<?php

declare(strict_types=1);

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateCustomerConstraints
{
    public static function get(): Collection
    {
        return new Collection([
            'allowExtraFields' => true,
            'fields' => [
                'userId' => [
                    new NotBlank(),
                    new Type('integer'),
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
                'birthday' => [
                    new NotBlank(['allowNull' => true]),
                    new Type('string'),
                ],
                'gender' => [
                    new Type('string'),
                    new Length(['min' => 3, 'max' => 12]),
                ],
                'phone' => [
                    new Type('string'),
                    new Length(['min' => 6, 'max' => 12]),
                ],
                'address' => [
                    new Type('string'),
                    new Length(['min' => 5, 'max' => 64]),
                ],
                'subscribedToNewsletter' => [
                    new Type('boolean'),
                ],
            ],
        ]);
    }
}
