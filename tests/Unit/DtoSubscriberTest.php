<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
use App\Event\PostDtoCreationEvent;
use App\Tests\ServiceTestCase;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;


class DtoSubscriberTest extends ServiceTestCase
{
    public function test_dto_validated_after_its_created(): void
    {
        $dto = new LowestPriceEnquiry();
        $dto->setQuantity(-10);

        $event = new PostDtoCreationEvent($dto);

        /** @var EventDispatcherInterface $eventDispatcher */
        $eventDispatcher = $this->containerInterface->get('debug.event_dispatcher');

        // Exptect
        $this->expectException(ValidationFailedException::class);
        $this->expectExceptionMessage("This value should be positive.");
        // msg nie jest przypadkowy 
        // wynika z Symfony\Component\Validator\Constraints\Positive;

        // When
        // dd($eventDispatcher->dispatch($event, $event::NAME));
        $eventDispatcher->dispatch($event, $event::NAME);
    }
}
