<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\LowestPriceFilter;
use App\Tests\ServiceTestCase;

class LowestPriceFilterTest extends ServiceTestCase
{

    public function test_lowest_price_filter_is_applied_correctly(): void
    {

        // Given
        $product = new Product();
        $product->setPrice(100);

        $enquiry = new LowestPriceEnquiry();
        $enquiry->setProduct($product);
        $enquiry->setQuantity(5);

        $promotions = $this->promotionsProvider();

        $lowePriceFilter = $this->containerInterface->get(LowestPriceFilter::class);

        // dd($lowePriceFilter);

        // When
        $filteredEnquiry = $lowePriceFilter->apply($enquiry, ...$promotions);

        // Then
        $this->assertSame(100, $filteredEnquiry->getPrice());
        $this->assertSame(250, $filteredEnquiry->getDiscountedPrice());
        $this->assertSame('BLACK FRIDAY PROMOCJA', $filteredEnquiry->getPromotionName());
    }

    public function promotionsProvider(): array
    {
        $promotion1 = new Promotion();
        $promotion1->setName('LETNIE PROMOCJE');
        $promotion1->setAdjustment(0.2);
        $promotion1->setCriteria([
            "from" => "2024-02-02",
            "to" => "2024-04-04",
        ]);
        $promotion1->setType('data_range_multiplier');

        $promotion2 = new Promotion();
        $promotion2->setName('DWA W CENIE JEDNEGO');
        $promotion2->setAdjustment(0.5);
        $promotion2->setCriteria([
            "minimum_quantity" => 2,
        ]);
        $promotion2->setType('minimum_two_same_items_multiplier');

        $promotion3 = new Promotion();
        $promotion3->setName('VOUCHER 1234');
        $promotion3->setAdjustment(20);
        $promotion3->setCriteria([
            "code" => "VOUCHER1234",
        ]);
        $promotion3->setType('fixed_price_voucher');

        return [$promotion1, $promotion2, $promotion3];
    }
}
