<?php

namespace App\Domain\Product\Interfaces;

use App\Domain\Product\Entities\Category;
use App\Infrastructure\Persistence\Product\Models\CategoryModel;
use Illuminate\Support\Collection;

interface CategoryServiceInterface
{
    public function getAll(): Collection;
    //public function create(Category $category): CategoryModel;
}
