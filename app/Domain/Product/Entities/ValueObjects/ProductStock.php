<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductStock
{


    public function __construct(
        private int $quantity, // quantity in stock
    ){}

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function inStock(): bool{
        return $this->quantity > 0; // TODO: improve this up
    }



}
