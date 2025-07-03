<?php

namespace App\Application\Product\DTOs\Category;

readonly class DeleteCategoryDTO
{

    public function __construct(
        private string $id,
    ){}

    public function getId(): string
    {
        return $this->id;
    }

}
