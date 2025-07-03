<?php

namespace App\Infrastructure\Persistence\Product\Eloquent;

use App\Domain\Product\Entities\Category;
use App\Domain\Product\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\Product\Mappers\CategoryMapper;
use App\Infrastructure\Persistence\Product\Models\CategoryModel;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return CategoryModel::all();
    }

    public function save(Category $category): void
    {
        $categoryModel = CategoryMapper::toModel($category);

        $categoryModel->save();
    }

    public function update(string $id): void
    {
        // TODO: Implement update() method.
    }
}
