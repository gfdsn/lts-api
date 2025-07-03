<?php

namespace App\Domain\Product\Category\Entities\ValueObjects;

class CategoryName
{

    public function __construct(
        private string $value,
    ){}

    public function getValue(): string
    {
        return $this->value;
    }
}
