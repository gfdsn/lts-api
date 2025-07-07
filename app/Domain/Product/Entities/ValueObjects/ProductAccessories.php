<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductAccessories
{

    /* an array of possible accessories that can be added */
    public function __construct(
        private array $accessories, // array of accessories ids
    ){}

    public function getAccessories(): array
    {
        return $this->accessories;
    }

}
