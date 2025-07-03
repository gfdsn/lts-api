<?php

namespace App\Application\Product\DTOs\Category;

readonly class StoreCategoryDTO
{

    public function __construct(
        private string $name,
    ){}

    public function getName(): string
    {
        return $this->name;
    }


}
