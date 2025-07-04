<?php

namespace App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects;

readonly class AccessoryProduct
{
    public function __construct(
        private string $product_id,
    ){}

    public function getProductId(): string
    {
        return $this->product_id;
    }

}
