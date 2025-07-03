<?php

namespace App\Domain\Product\Repositories;


use App\Domain\Product\Entities\Category;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function save(Category $category): void;
    public function update(string $id): void;
}
