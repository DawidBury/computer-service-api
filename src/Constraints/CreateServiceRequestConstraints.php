<?php

declare(strict_types=1);

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateServiceRequestConstraints
{
    public static function get(): Collection
    {
        return new Collection([
            'allowExtraFields' => true,
            'fields' => [
                'customerId' => [
                    new NotBlank(),
                    new Type('integer'),
                ],
                'subject' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['min' => 3, 'max' => 255]),
                ],
                'description' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['min' => 3, 'max' => 255]),
                ],
            ],
        ]);
    }
}
