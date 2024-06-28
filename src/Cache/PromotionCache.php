<?php

namespace App\Cache;

use App\Entity\Product;
use App\Repository\PromotionRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PromotionCache
{
    public function __construct(private CacheInterface $cacheInterface, private PromotionRepository $promotionRepository)
    {
    }

    public function findValidPromotionForProduct(Product $product, string $requestDate): ?array
    {
        $key = sprintf("get-valid-promotion-for-product-%d", $product->getId());

        return $this->cacheInterface->get($key, function (ItemInterface $item) use ($product, $requestDate) {

            $item->expiresAfter(1800); // 30min

            // var_dump("cache-miss");

            return  $this->promotionRepository->getValidPromotionsForProduct(
                $product,
                date_create_immutable($requestDate)
            );
        });
    }
}
