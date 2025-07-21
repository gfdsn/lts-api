<?php

namespace App\Application\User\DTOs\Cart;

readonly class RemoveFromCartDTO
{

    public function __construct(
        private string $productId,
    ){}

    public function getProductId(): string
    {
        return $this->productId;
    }

}
