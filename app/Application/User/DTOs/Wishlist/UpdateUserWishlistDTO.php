<?php

namespace App\Application\User\DTOs\Wishlist;

readonly class UpdateUserWishlistDTO
{

    public function __construct(
        private string $user_id,
        private string $product_id,
    ){}

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

}
