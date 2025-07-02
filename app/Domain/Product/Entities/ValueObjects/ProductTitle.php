<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductTitle
{

    public function __construct(
        private string $value
    ){}

    public function value(): string
    {
        return $this->value;
    }

}
