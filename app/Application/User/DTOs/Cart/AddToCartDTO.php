<?php

namespace App\Application\User\DTOs\Cart;

readonly class AddToCartDTO
{

    public function __construct(
        public string $product_id,
        public int $quantity,
    ){}

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

}
