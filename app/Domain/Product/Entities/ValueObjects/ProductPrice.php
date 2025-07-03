<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductPrice
{

    /* prices here are in cents */

    public function __construct(
        private int $value,
    ){}

    public function getValue(): int
    {
        return $this->value;
    }

}
