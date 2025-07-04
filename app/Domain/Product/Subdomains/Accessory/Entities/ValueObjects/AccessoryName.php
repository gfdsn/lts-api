<?php

namespace App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects;

readonly class AccessoryName
{

    public function __construct(
        private string $value,
    ){}

    public function getValue(): string
    {
        return $this->value;
    }

}
