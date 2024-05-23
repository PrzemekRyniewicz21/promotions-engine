<?php

namespace App\Filter\Modifiers;

class FixedPrice extends PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquriry): int
    {
        // sprawdzmy czy 
        return 1;
    }
}
