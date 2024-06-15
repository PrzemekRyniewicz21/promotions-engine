<?php

namespace App\Filter\Modifiers;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class PairOfItemsModifier implements PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquriry): int
    {

        // Jesli mamy mniej niz dwa produkty, zwracamy cene bez rabatu
        if ($quantity < 2) {
            return $price * $quantity;
        }

        // Jesli ilosc przedmiotu % 2 == 0 wiemy, ze mamy parzysta ilosc, wiec placimy tylko za połowe przedmiotow
        // Jesli ilosc przedmiotu % 2 != 0 wiemy, ze jeden z przedmiotow nie zostanie objety promocja, wiec go odejmujemy
        // wiec go odejmujemy, obliczamy promocje na naszej parzystej liczbe produktow i dodajemy cene produktu bez pary

        if (($quantity % 2) == 0) {
            return ($price * $quantity) * 0.5;
        } else {
            return (($price * ($quantity - 1)) * 0.5) + $price;
        }
    }
}
