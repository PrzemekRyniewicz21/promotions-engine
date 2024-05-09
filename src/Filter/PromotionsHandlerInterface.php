<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;

interface PromotionsHandlerInterface
{
    public function apply(PromotionEnquiryInterface $enquiry): PromotionEnquiryInterface;
}
