<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductImage
{
    /* product's images url paths */

    public function __construct(
        private array $images
    ){}

    public function getImages(): array
    {
        return $this->images;
    }



}
