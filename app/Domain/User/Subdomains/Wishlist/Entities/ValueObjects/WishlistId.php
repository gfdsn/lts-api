<?php

namespace App\Domain\User\Subdomains\Wishlist\Entities\ValueObjects;

use Illuminate\Support\Str;

class WishlistId
{

    public function __construct(
        private ?string $value = null
    ){
        $this->value = $this->value ?? Str::uuid()->toString();
    }

    public function getValue(): string
    {
        return $this->value;
    }
    
}
