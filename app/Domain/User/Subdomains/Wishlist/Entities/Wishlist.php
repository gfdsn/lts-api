<?php

namespace App\Domain\User\Subdomains\Wishlist\Entities;

use App\Domain\User\Subdomains\Wishlist\Entities\ValueObjects\WishlistId;
use App\Domain\User\Subdomains\Wishlist\Entities\ValueObjects\WishlistProductId;
use App\Domain\User\Subdomains\Wishlist\Entities\ValueObjects\WishlistUserId;

class Wishlist
{
    public function __construct(
        private WishlistId $id,
        private WishlistUserId $user_id,
        private WishlistProductId $product_id,
    ){}

    public function getId(): string
    {
        return $this->id->getValue();
    }

    public function getUserId(): string
    {
        return $this->user_id->getValue();
    }

    public function getProductId(): string
    {
        return $this->product_id->getValue();
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id->getValue(),
            "user_id" => $this->user_id->getValue(),
            "product_id" => $this->product_id->getValue()
        ];
    }

}


