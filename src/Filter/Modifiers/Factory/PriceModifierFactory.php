<?php

namespace App\Filter\Modifiers\Factory;

use App\Filter\Modifiers\Factory\PriceModifierFactoryInterface;
use App\Filter\Modifiers\PriceModifierInterface;
use Laminas\Code\Generator\Exception\ClassNotFoundException;
use Symfony\Component\ErrorHandler\Error\ClassNotFoundError;

class PriceModifierFactory implements PriceModifierFactoryInterface
{

    // public function create(string $modifierType): PriceModifierFactoryInterface
    public function create(string $modifierType)
    {

        // Rozdzielamy typ modyfikatora na czesci wedlug znaku _
        $parts = explode('_', $modifierType);

        // Przez kazda czesc przechodzimy funkcja ucfirst, aby zmienic pierwsza litere na wielka
        $parts = array_map('ucfirst', $parts);

        // Laczymy wszystko w jeden string
        $modifierClassName = implode('', $parts);


        $modifierClass = self::MODIFIER_NAMESPACE . $modifierClassName;

        if (!class_exists($modifierClass)) {
            throw new ClassNotFoundException($modifierClass);
        }

        return new $modifierClass;
    }
}
