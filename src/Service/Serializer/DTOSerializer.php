<?php

namespace App\Service\Serializer;

use App\Event\PostDtoCreationEvent;
use Symfony\Component\DependencyInjection\Attribute\When;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class DTOSerializer implements SerializerInterface
{
    private SerializerInterface $serializer;

    public function __construct(private EventDispatcherInterface $dispatcher)
    {
        $this->serializer = new Serializer(

            // normalizers
            [new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())],

            // encoders
            [new JsonEncoder()]

        );
    }

    public function serialize(mixed $data, string $format, array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        $dto = $this->serializer->deserialize($data, $type, $format, $context);

        $event = new PostDtoCreationEvent($dto);
        $this->dispatcher->dispatch($event, $event::NAME);
        return $dto;
    }
}
