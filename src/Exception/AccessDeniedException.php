<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class AccessDeniedException extends Exception implements ApiExceptionInterface
{
    public function __construct()
    {
        parent::__construct(
            'Access denied',
            JsonResponse::HTTP_FORBIDDEN
        );
    }
}
