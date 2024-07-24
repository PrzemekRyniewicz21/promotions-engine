<?php

namespace App\EventSubscriber;

use App\Event\PostDtoCreationEvent;
use App\Service\Exceptions\Data\ExceptionPayloadData;
use App\Service\Exceptions\ServiceException;
use App\Service\Exceptions\Data\ValidationErrorData;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoSubscriber implements EventSubscriberInterface
{

    public function __construct(private ValidatorInterface $validator)
    {
    }
    public static function getSubscribedEvents(): array
    {
        return [
            PostDtoCreationEvent::NAME => 'validateDto',

        ];
    }

    public function validateDto(PostDtoCreationEvent $event): void
    {
        // Validate dto
        $dto = $event->getDto();
        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {

            $exceptionPayloadData = new ValidationErrorData(422, 'Constraint violation list', $errors);

            throw new ServiceException($exceptionPayloadData);
        }
    }
}
