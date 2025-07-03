<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductDescription
{
    public function __construct(
        private string $value,
    ){}

    public function value(): string
    {
        return $this->value;
    }
}
