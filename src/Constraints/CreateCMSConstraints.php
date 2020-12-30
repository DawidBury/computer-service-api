<?php

declare(strict_types=1);

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateCMSConstraints
{
    public static function get(): Collection
    {
        return new Collection([
            'allowExtraFields' => true,
            'fields' => [
                'attribute' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['max' => 64]),
                ],
                'value' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['max' => 64]),
                ],
            ],
        ]);
    }
}
