<?php

namespace App\Filter\Modifiers;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class FixedPriceModifier implements PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquriry): int
    {
        $code = $promotion->getCriteria()['code'];
        $enquriry_code = $enquriry->getVoucherCode();

        if ($code === $enquriry_code) {
            return $promotion->getAdjustment() * $quantity;
        }

        return $price * $quantity;
    }
}
