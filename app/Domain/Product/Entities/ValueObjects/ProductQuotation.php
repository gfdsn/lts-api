<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductQuotation
{

    /* prices here are in cents */

    public function __construct(
        private int $price,
        private int $discount_value = 0,
    ){}

    public function getValue(): int
    {
        return $this->price;
    }

    public function isDiscountValue(): bool
    {
        return $this->discount_value;
    }

    public function toArray(): array
    {
        return ["price" => $this->price, "discount_value" => $this->discount_value];
    }

}
