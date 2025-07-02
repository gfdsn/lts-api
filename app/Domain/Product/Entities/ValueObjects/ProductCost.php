<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductCost
{

    /* prices here are in cents */

    public function __construct(
        private int $price,
        private int $shippingPrice
    ){}

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getShippingPrice(): int
    {
        return $this->shippingPrice;
    }

    public function toArray(): array
    {
        return ["price" => $this->price, "shippingPrice" => $this->shippingPrice];
    }


}
