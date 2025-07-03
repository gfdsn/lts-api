<?php

namespace App\Domain\Product\Entities\ValueObjects\Category;

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
