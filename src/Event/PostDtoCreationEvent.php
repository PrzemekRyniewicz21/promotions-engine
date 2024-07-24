<?php

namespace App\Event;

use App\DTO\PromotionEnquiryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class PostDtoCreationEvent extends Event
{
    public const NAME = 'dto.created';

    public function __construct(private PromotionEnquiryInterface $dto)
    {
        // dd("??");
    }

    public function getDto(): PromotionEnquiryInterface
    {
        return $this->dto;
    }
}
