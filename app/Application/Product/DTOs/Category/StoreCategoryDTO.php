<?php

namespace App\Application\Product\DTOs\Category;

readonly class StoreCategoryDTO
{

    public function __construct(
        private string $name,
        private string $icon,
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

}
