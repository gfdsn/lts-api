<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductClassification
{

    public function __construct(
        private ProductCategory $category,
        private ProductCategory $subcategory,
    ){}

    public function getCategory(): ProductCategory
    {
        return $this->category;
    }

    public function getSubcategory(): ProductCategory
    {
        return $this->subcategory;
    }

    public function toArray(): array
    {
        return ["category" => $this->category->getName(), "subcategory" => $this->subcategory->getName()];
    }

}
