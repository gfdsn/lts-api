<?php

namespace App\Infrastructure\Persistence\Product\Mappers;

use App\Domain\Product\Entities\Category;
use App\Infrastructure\Persistence\Product\Models\CategoryModel;

class CategoryMapper
{
    public static function toModel(Category $category): CategoryModel
    {
        return new CategoryModel([
            "id" => $category->getId(),
            "name" => $category->getName(),
        ]);
    }
}
