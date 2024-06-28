<?php

namespace App\DTO;

interface PriceEnquiryInterface extends PromotionEnquiryInterface
{
    public function setPrice(int $price);
    public function setDiscountPrice(int $dPrice);
    public function getQuantity(): ?int; // moze byc null  lub int
}
