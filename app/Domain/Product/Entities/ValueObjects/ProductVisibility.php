<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductVisibility
{

    public function __construct(
        private bool $value = true
    ){}

    public function getValue(): bool
    {
        return $this->value;
    }
}
