<?php

namespace App\Service\Exceptions\Data;

class ExceptionPayloadData extends AbstractExceptionData
{
    public function __construct(protected int $statusCode, protected string $type)
    {
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getType()
    {
        return $this->type;
    }

    public function toArray(): array
    {
        return [

            'type' => $this->type,

        ];
    }
}