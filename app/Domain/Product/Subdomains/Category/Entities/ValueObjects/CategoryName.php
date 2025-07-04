<?php

namespace App\Domain\Product\Subdomains\Category\Entities\ValueObjects;

readonly class CategoryName
{

    public function __construct(
        private string $value,
    ){}

    public function getValue(): string
    {
        return $this->value;
    }
}
