<?php

namespace App\Filter\Modifiers;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class DateRangeMultiplier implements PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquriry): int
    {
        $requestDate = date_create($enquriry->getRequestDate());
        $from = date_create($promotion->getCriteria()['from']);
        $to = date_create($promotion->getCriteria()['to']);

        // dd($requestDate, $from, $to);

        if (!($requestDate >= $from && $requestDate <= $to)) {
            return $price * $quantity;
        }

        return ($price * $quantity) * $promotion->getAdjustment();
    }
}
