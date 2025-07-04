<?php

namespace App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects;

readonly class AccessoryPrice
{

    public function __construct(
        private int $value
    ){}

    public function getValue(): int
    {
        return $this->value;
    }

}
