<?php

namespace App\EventListener;

use App\Service\Exceptions\Data\ExceptionPayloadData;
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
        // dd($exception);

        if ($exception instanceof ServiceException) {
            $exceptionPayloadData = $exception->getExceptionPayloadData();
        } else {

            $statusCode = $exception->getCode();
            $msg = $exception->getMessage();

            $exceptionPayloadData = new ExceptionPayloadData($statusCode, $msg);
        }

        $response = new JsonResponse($exceptionPayloadData->toArray());

        $event->setResponse($response);
    }
}
