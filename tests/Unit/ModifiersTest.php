<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Promotion;
use App\Filter\Modifiers\DateRangeMultiplier;
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
        $this->assertEquals(250, $modifiedPrice);
    }
}
