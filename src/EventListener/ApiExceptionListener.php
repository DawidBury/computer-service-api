<?php declare(strict_types=1);

namespace App\EventListener;

use App\Exception\ApiExceptionInterface;
use App\Utils\ApiResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof ApiExceptionInterface) {
            return;
        }

        $event->setResponse(
            $this->createApiResponse($exception)
        );
    }

    private function createApiResponse($exception)
    {
        $parsedString = str_replace('"', "", $exception->getMessage());
        return new ApiResponse($parsedString, null, [], $exception->getCode());
    }
}
