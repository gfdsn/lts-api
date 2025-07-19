<?php

namespace App\Application\Product\DTOs;

readonly class ShowProductDTO
{

    public function __construct(
        private string $slug
    ){}

    public function getSlug(): string
    {
        return $this->slug;
    }

}
