<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductQuotation
{

    /* prices here are in cents */
    private int $finalPrice;

    public function __construct(
        private int $price,
        private int $discount_value = 0,
    ){
        $this->finalPrice = $price - ($price * ($this->discount_value / 100));
    }

    public function getValue(): int
    {
        return $this->price;
    }

    public function toArray(): array
    {
        return ["price" => $this->price, "final_price" => $this->finalPrice , "discount_value" => $this->discount_value];
    }

}
