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

class UpdateCMSConstraints
{
    public static function get(): Collection
    {
        return new Collection([
            'allowExtraFields' => true,
            'fields' => [
                'id' => [
                    new NotBlank(),
                    new Type('integer')
                ],
                'attribute' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['max' => 64])
                ],
                'value' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length(['max' => 64])
                ],
                'active' => [
                    new NotBlank(),
                    new Type('bool')
                ]
            ]
        ]);
    }
}
