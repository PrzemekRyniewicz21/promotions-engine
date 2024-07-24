<?php

namespace App\Service\Exceptions\Data;

use Symfony\Component\Validator\ConstraintViolationList;

class ValidationErrorData extends AbstractExceptionData
{
    private ConstraintViolationList $violationsList;

    public function __construct(int $statusCode, string $type, ConstraintViolationList $constraintList)
    {
        $this->violationsList = $constraintList;

        parent::__construct($statusCode, $type);
    }



    public function toArray(): array
    {
        return [

            'type' => 'Constraint violation data',
            'violations' => $this->getViolations(),

        ];
    }

    public function getViolations()
    {
        $violations = [];

        foreach ($this->violationsList as $violation) {


            $violations[] = [

                'propertyPath' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),

            ];
        }


        return $violations;
    }
}
