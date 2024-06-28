<?php

namespace App\Filter;

use App\DTO\PriceEnquiryInterface;
use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

interface PrieceFilterInterface extends PromotionsHandlerInterface
{
    public function apply(PriceEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface;
}
