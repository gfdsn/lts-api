<?php

namespace App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects;

readonly class AccessoryStock
{

    public function __construct(
        private int $value,
    ){}

    public function getValue(): int
    {
        return $this->value;
    }

}
