<?php

namespace App\Domain\Product\Subdomains\Category\Entities\ValueObjects;

readonly class CategoryIcon
{

    public function __construct(
        private string $value,
    ){}

    public function getValue(): string
    {
        return $this->value;
    }
    
}
