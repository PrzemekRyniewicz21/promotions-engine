<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\Modifiers\DateRangeMultiplier;
use App\Filter\Modifiers\FixedPriceModifier;
use App\Filter\Modifiers\PairOfItemsModifier;
use App\Tests\ServiceTestCase;

class ModifiersTest extends ServiceTestCase
{
    public function test_date_range_multiplier_modifier_modifies_price_correctly()
    {
        // Given

        $enquiry = new LowestPriceEnquiry();
        $enquiry->setQuantity(5);
        $enquiry->setRequestDate('2024-03-01');

        $promotion = new Promotion();
        $promotion->setName('LETNIE PROMOCJE');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria([
            "from" => "2024-02-02",
            "to" => "2024-04-04",
        ]);
        $promotion->setType('data_range_multiplier');

        $dateRnageModifier = new DateRangeMultiplier();

        // When
        $modifiedPrice = $dateRnageModifier->modify(100, 5, $promotion, $enquiry);

        // Then
        $this->assertEquals(250.0, $modifiedPrice);
    }

    public function test_fixed_price_modifier_modifies_price_correctly()
    {
        // Given
        $enquiry = new LowestPriceEnquiry();
        $enquiry->setQuantity(2);
        $enquiry->setVoucherCode("VOUCHER_TEST");

        $promotion = new Promotion();
        $promotion->setName("VOUCHER");
        $promotion->setAdjustment(100);
        $promotion->setCriteria([
            'code' => 'VOUCHER_TEST',
        ]);
        $promotion->setType('fixed_price_voucher');

        $fixedPriceModifier = new FixedPriceModifier();

        // When
        $fixedPrice = $fixedPriceModifier->modify(200, 5, $promotion, $enquiry);

        // Then
        $this->assertEquals(500, $fixedPrice);
    }

    public function test_pair_of_items_modifier_modifies_price_correctly()
    {
        // Given
        $enquiry = new LowestPriceEnquiry();

        // dd($enquiry);


        $promotion = new Promotion();
        $promotion->setName("TWO_IN_PRICE_OF_ONE");
        $promotion->setAdjustment(0.5);
        $promotion->setType('pair_of_items_multiplier');

        $paitOfItemsMultiplier = new PairOfItemsModifier();

        // When
        $price = $paitOfItemsMultiplier->modify(200, 5, $promotion, $enquiry);

        // Then
        $this->assertEquals(600, $price);
    }
}
