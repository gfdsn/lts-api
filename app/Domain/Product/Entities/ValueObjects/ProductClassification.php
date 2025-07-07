<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductClassification
{

    public function __construct(
        private string $category_id,
        private string $subcategory_id,
    ){}

    public function getCategoryId(): string
    {
        return $this->category_id;
    }

    public function getSubcategoryId(): string
    {
        return $this->subcategory_id;
    }

    public function toArray(): array
    {
        return ["category_id" => $this->category_id, "subcategory_id" => $this->subcategory_id];
    }

}
