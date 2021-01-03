<?php

declare(strict_types=1);

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateTaskConstraints
{
    public static function get(): Collection
    {
        return new Collection([
            'allowExtraFields' => true,
            'fields' => [
                'priority' => [
                    new NotBlank(),
                    new Type('integer'),
                ],
                'taskTypeId' => [
                    new NotBlank(),
                    new Type('integer'),
                ],
            ],
        ]);
    }
}
