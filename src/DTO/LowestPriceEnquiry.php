<?php

namespace App\DTO;

use App\Entity\Product;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

class LowestPriceEnquiry implements PriceEnquiryInterface
{
    #[Ignore]
    private ?Product $product;

    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $quantity;

    private ?string $requestLocation;

    private ?string $voucherCode;

    #[Assert\NotBlank]
    private ?string $requestDate;

    #[Assert\Positive]
    private ?int $price;

    private ?int $discountPrice;

    private ?int $promotionId;

    private ?string $promotionName;



    // ... gettery i settery


    /**
     * Get the value of quantity
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of requestLocation
     */
    public function getRequestLocation()
    {
        return $this->requestLocation;
    }

    /**
     * Set the value of requestLocation
     *
     * @return  self
     */
    public function setRequestLocation($requestLocation)
    {
        $this->requestLocation = $requestLocation;

        return $this;
    }

    /**
     * Get the value of voucherCode
     */
    public function getVoucherCode()
    {
        return $this->voucherCode;
    }

    /**
     * Set the value of voucherCode
     *
     * @return  self
     */
    public function setVoucherCode($voucherCode)
    {
        $this->voucherCode = $voucherCode;

        return $this;
    }

    /**
     * Get the value of requestDate
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * Set the value of requestDate
     *
     * @return  self
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of discountPrice
     */
    public function getDiscountedPrice()
    {
        return $this->discountPrice;
    }

    /**
     * Set the value of discountPrice
     *
     * @return  self
     */
    public function setDiscountPrice($dPrice)
    {
        $this->discountPrice = $dPrice;

        return $this;
    }

    /**
     * Get the value of promotionId
     */
    public function getPromotionId()
    {
        return $this->promotionId;
    }

    /**
     * Set the value of promotionId
     *
     * @return  self
     */
    public function setPromotionId(int $promotionId): void
    {
        $this->promotionId = $promotionId;
    }

    /**
     * Get the value of promotionName
     */
    public function getPromotionName()
    {
        return $this->promotionName;
    }

    /**
     * Set the value of promotionName
     *
     * @return  self
     */
    public function setPromotionName(string $promotionName): void
    {
        $this->promotionName = $promotionName;
    }

    // uzywamy symfony serializer, so i commented it out
    // Implementujemy PromotionEnquiryInterface rozszerzony JsonSerializable
    // JsonSerializable wymaga od nas implementacji jsonSerialize(),
    // wiec usuwamy to rozszrzenie z interfejsu

    // public function jsonSerialize()
    // {
    //     return get_object_vars($this);
    // }

    /**
     * Get the value of product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @return  self
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }
}
