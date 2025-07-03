<?php

namespace App\Infrastructure\Persistence\Product\Mappers;

use App\Application\Product\DTOs\Category\StoreCategoryDTO;
use App\Domain\Product\Category\Entities\Category;
use App\Domain\Product\Category\Entities\ValueObjects\CategoryId;
use App\Domain\Product\Category\Entities\ValueObjects\CategoryName;
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

    public static function toDomain(CategoryModel $categoryModel): Category
    {
        return new Category(
            new CategoryId($categoryModel->id),
            new CategoryName($categoryModel->name)
        );
    }

    public static function fromDtoToDomain(StoreCategoryDTO $dto): Category
    {
        return new Category(
            new CategoryId(),
            new CategoryName($dto->getName())
        );
    }
}
