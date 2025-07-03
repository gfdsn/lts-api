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

    public function update(CategoryModel $categoryModel, Category $updatedCategory): void
    {
        $categoryModel->update($updatedCategory->toArray());
    }

    public function find(string $id): CategoryModel
    {
        return CategoryModel::find($id);
    }

    public function destroy(string $id): bool
    {
        $category = $this->find($id);

        return $category->delete();
    }
}
