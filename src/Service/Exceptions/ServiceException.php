<?php

namespace App\Service\Exceptions;

use App\Service\Exceptions\Data\AbstractExceptionData;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ServiceException extends HttpException
{
    private AbstractExceptionData $exceptionData;
    public function __construct(AbstractExceptionData $exceptionData)
    {
        $this->exceptionData = $exceptionData;
        $statusCode = $exceptionData->getStatusCode();
        $type = $exceptionData->getType();

        parent::__construct($statusCode, $type);
    }

    public function getExceptionPayloadData()
    {
        return $this->exceptionData;
    }
}
