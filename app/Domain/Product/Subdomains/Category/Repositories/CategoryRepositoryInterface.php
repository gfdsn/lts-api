<?php

namespace App\Domain\Product\Subdomains\Category\Repositories;


use App\Domain\Product\Subdomains\Category\Entities\Category;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function save(Category $category): void;
    public function update(CategoryModel $categoryModel, Category $updatedCategory): void;
    public function find(string $id): CategoryModel;
    public function destroy(string $id): bool;
    public function random(int $count): Collection;
}
