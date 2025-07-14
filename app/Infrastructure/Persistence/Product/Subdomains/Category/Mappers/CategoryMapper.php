<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Category\Mappers;

use App\Application\Product\DTOs\Category\StoreCategoryDTO;
use App\Domain\Product\Subdomains\Category\Entities\Category;
use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryIcon;
use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryId;
use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryName;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;

class CategoryMapper
{
    public static function toModel(Category $category): CategoryModel
    {
        return new CategoryModel([
            "id" => $category->getId(),
            "name" => $category->getName(),
            "icon" => $category->getIcon(),
        ]);
    }

    public static function toDomain(CategoryModel $categoryModel): Category
    {
        return new Category(
            new CategoryId($categoryModel->id),
            new CategoryName($categoryModel->name),
            new CategoryIcon($categoryModel->icon)
        );
    }

    public static function fromStoreDtoToDomain(StoreCategoryDTO $dto): Category
    {
        return new Category(
            new CategoryId(),
            new CategoryName($dto->getName()),
            new CategoryIcon($dto->getIcon())
        );
    }
}
