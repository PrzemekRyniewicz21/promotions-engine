<?php

namespace App\EventListener;

use App\Service\Exceptions\ServiceException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    // public function onKernelException(ExceptionEvent $event): void
    public function exceptionHandler(ExceptionEvent $event): void
    {

        $exception = $event->getThrowable();

        $object = $exception->getExceptionPayloadData();

        $response = new JsonResponse($object->toArray());


        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        } else {
            $response->setStatusCode(500);
        }

        $event->setResponse($response);
    }
}
