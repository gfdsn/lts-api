<?php

namespace App\Domain\User\Subdomains\Wishlist\Entities\ValueObjects;

readonly class WishlistProductId
{
    
    public function __construct(
        private string $value,
    ){}

    public function getValue(): string
    {
        return $this->value;
    }

}
