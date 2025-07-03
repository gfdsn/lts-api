<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductCategory
{

    public function __construct(
        private  string $name,
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    /* get all products from this category etc... */

}
