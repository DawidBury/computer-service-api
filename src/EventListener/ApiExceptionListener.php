<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\ApiExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof ApiExceptionInterface) {
            return;
        }

        $response = new JsonResponse($this->buildResponseData($exception));
        $response->setStatusCode($exception->getCode());

        $event->setResponse($response);
    }

    private function buildResponseData(ApiExceptionInterface $exception): array
    {
        $messages = json_decode($exception->getMessage(), true);
        if (!is_array($messages)) {
            $messages = $exception->getMessage() ? [$exception->getMessage()] : [];
        }

        return [
            'error' => [
                'code' => $exception->getCode(),
                'messages' => $messages
            ]
        ];
    }
}
