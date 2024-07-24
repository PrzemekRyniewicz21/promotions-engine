<?php

namespace App\Filter\Modifiers\Factory;

use App\Filter\Modifiers\PriceModifierInterface;

interface PriceModifierFactoryInterface
{
    const MODIFIER_NAMESPACE = "App\Filter\Modifiers\\";

    // public function create(string $modifierType): PriceModifierInterface;
    public function create(string $modifierType);
}
