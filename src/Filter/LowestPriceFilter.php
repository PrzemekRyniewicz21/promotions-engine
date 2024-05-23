<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class LowestPriceFilter implements PromotionsHandlerInterface
{
    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
    {
        $price = $enquiry->getProduct()->getPrice();
        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;



        // $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);

        // 3. Return modified Enquiry
        $enquiry->setDiscountPrice(250);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(3);
        $enquiry->setPromotionName('BLACK FRIDAY PROMOCJA');

        return $enquiry;
    }
}
