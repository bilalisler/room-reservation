<?php

namespace App\EventListener;

use App\Exception\FormErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $error = [
            'message' => $exception->getMessage()
        ];

        if ($exception instanceof FormErrorException) {
            $error = [
                'message' => json_decode($exception->getMessage(), true)
            ];
        }

        $code = $exception->getCode() > 0 ? $exception->getCode() : 400;

        $event->setResponse(new JsonResponse($error, $code));
    }
}
