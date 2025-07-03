<?php

namespace App\Application\Product\DTOs\Category;

readonly class UpdateCategoryDTO
{

    public function __construct(
        private string $id,
        private string $name,
    ){}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
