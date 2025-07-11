<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductStock
{

    public function __construct(
        private int $value,
    ){}

    public function getValue(): int
    {
        return $this->value;
    }

}
