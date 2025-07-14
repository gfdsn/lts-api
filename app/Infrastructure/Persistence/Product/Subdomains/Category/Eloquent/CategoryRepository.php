<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Category\Eloquent;

use App\Domain\Product\Subdomains\Category\Entities\Category;
use App\Domain\Product\Subdomains\Category\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Mappers\CategoryMapper;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return CategoryModel::all();
    }

    public function save(Category $category): void
    {
        $categoryModel = CategoryMapper::toModel($category);

        $categoryModel->slug = Str::slug($categoryModel->name);

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

    public function random(int $count): Collection
    {
        return CategoryModel::all()->random($count);
    }
}
