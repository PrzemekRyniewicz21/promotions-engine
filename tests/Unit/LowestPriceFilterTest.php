<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceEnquiry;
<<<<<<< HEAD
=======
use App\Entity\Product;
>>>>>>> dev
use App\Entity\Promotion;
use App\Filter\LowestPriceFilter;
use App\Tests\ServiceTestCase;

class LowestPriceFilterTest extends ServiceTestCase
{

    public function test_lowest_price_filter_is_applied_correctly(): void
    {

        // Given
<<<<<<< HEAD
        $enquiry = new LowestPriceEnquiry();

=======

        $product = new Product();
        $product->setPrice(100);

        $enquiry = new LowestPriceEnquiry();
        $enquiry->setProduct($product);
        $enquiry->setQuantity(5);
        $enquiry->setRequestDate('2024-06-06');
        $enquiry->setVoucherCode('VO21');
>>>>>>> dev
        $promotions = $this->promotionsProvider();

        $lowePriceFilter = $this->containerInterface->get(LowestPriceFilter::class);

<<<<<<< HEAD
        // dd($lowePriceFilter);

        // When
        $filteredEnquiry = $lowePriceFilter->apply($enquiry, ...$promotions);

        // Then
        $this->assertSame(100, $filteredEnquiry->getPrice());
        $this->assertSame(50, $filteredEnquiry->getDiscountedPrice());
        $this->assertSame('BLACK FRIDAY PROMOCJA', $filteredEnquiry->getPromotionName());
=======
        // When
        $filteredEnquiry = $lowePriceFilter->apply($enquiry, ...$promotions);
        // Then
        $this->assertSame(500, $filteredEnquiry->getPrice());
        $this->assertSame(100, $filteredEnquiry->getDiscountedPrice());
        $this->assertSame('LETNIE PROMOCJE', $filteredEnquiry->getPromotionName());
>>>>>>> dev
    }

    public function promotionsProvider(): array
    {
        $promotion1 = new Promotion();
<<<<<<< HEAD
=======
        $promotion1->setId(2);
>>>>>>> dev
        $promotion1->setName('LETNIE PROMOCJE');
        $promotion1->setAdjustment(0.2);
        $promotion1->setCriteria([
            "from" => "2024-02-02",
<<<<<<< HEAD
            "to" => "2024-04-04",
        ]);
        $promotion1->setType('data_range_multiplier');

        $promotion2 = new Promotion();
=======
            "to" => "2024-08-08",
        ]);
        $promotion1->setType('date_range_multiplier');

        $promotion2 = new Promotion();
        $promotion1->setId(1);
>>>>>>> dev
        $promotion2->setName('DWA W CENIE JEDNEGO');
        $promotion2->setAdjustment(0.5);
        $promotion2->setCriteria([
            "minimum_quantity" => 2,
        ]);
<<<<<<< HEAD
        $promotion2->setType('minimum_two_same_items_multiplier');

        $promotion3 = new Promotion();
=======
        $promotion2->setType('pair_of_items_modifier');

        $promotion3 = new Promotion();
        $promotion1->setId(4);
>>>>>>> dev
        $promotion3->setName('VOUCHER 1234');
        $promotion3->setAdjustment(20);
        $promotion3->setCriteria([
            "code" => "VOUCHER1234",
        ]);
<<<<<<< HEAD
        $promotion3->setType('fixed_price_voucher');
=======
        $promotion3->setType('fixed_price_modifier');
>>>>>>> dev

        return [$promotion1, $promotion2, $promotion3];
    }
}
