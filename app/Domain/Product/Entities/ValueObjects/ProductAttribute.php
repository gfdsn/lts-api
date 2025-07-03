<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductAttribute
{

    public function __construct(
        private int $weight,
        private string $color,
        /* ... */
    ){}

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function toArray(): array
    {
        return ["weight" => $this->weight, "color" => $this->color];
    }


}
