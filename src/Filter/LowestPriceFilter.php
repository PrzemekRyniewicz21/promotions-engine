<?php

namespace App\Filter;

<<<<<<< HEAD
use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class LowestPriceFilter implements PromotionsHandlerInterface
{
    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
    {
        // 3. Return modified Enquiry
        $enquiry->setDiscountPrice(50);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(3);
        $enquiry->setPromotionName('BLACK FRIDAY PROMOCJA');
=======
use App\DTO\PriceEnquiryInterface;
use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifiers\Factory\PriceModifierFactoryInterface;

use function PHPSTORM_META\type;

class LowestPriceFilter implements PrieceFilterInterface
{

    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
    {
    }
    public function apply(PriceEnquiryInterface $enquiry, Promotion ...$promotions): PromotionEnquiryInterface
    {
        $price = $enquiry->getProduct()->getPrice();
        $quantity = $enquiry->getQuantity();
        $enquiry->setPrice($price * $quantity);

        $lowestPrice = $enquiry->getPrice();


        foreach ($promotions as $promotion) {

            $priceModifier = $this->priceModifierFactory->create($promotion->getType());
            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);

            if ($modifiedPrice < $lowestPrice) {

                $enquiry->setDiscountPrice($modifiedPrice);
                $enquiry->setPromotionId($promotion->getId());
                $enquiry->setPromotionName($promotion->getName());

                $lowestPrice = $modifiedPrice;
            }
        }
>>>>>>> dev

        return $enquiry;
    }
}
