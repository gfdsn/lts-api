<?php

namespace App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects;

readonly class AccessoryDetails
{

    public function __construct(
        private string $value,
    ){}

    public function getValue(): string
    {
        return $this->value;
    }

}
