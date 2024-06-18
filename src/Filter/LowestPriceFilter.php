<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifiers\Factory\PriceModifierFactoryInterface;

use function PHPSTORM_META\type;

class LowestPriceFilter implements PromotionsHandlerInterface
{

    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
    {
    }
    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotions): PromotionEnquiryInterface
    {
        $price = $enquiry->getProduct()->getPrice();
        $enquiry->setPrice($price);

        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;


        foreach ($promotions as $promotion) {

            $priceModifier = $this->priceModifierFactory->create($promotion->getType());
            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);


            // dd(gettype($priceModifier));
            // dd([gettype($price), gettype($quantity), gettype($promotion), gettype($enquiry)]);

            if ($modifiedPrice < $lowestPrice) {

                $enquiry->setDiscountPrice($modifiedPrice);
                $enquiry->setPromotionId($promotion->getId());
                $enquiry->setPromotionName($promotion->getName());
                $enquiry->setPrice($modifiedPrice);
                $lowestPrice = $modifiedPrice;

                // setPrice() nie ma sensu, dlatego ze wartosc ta, bedzie zawsze taka sama
            }
        }

        return $enquiry;
    }
}
