<?php

namespace App\Domain\Product\Category\Interfaces;

use App\Application\Product\DTOs\Category\DeleteCategoryDTO;
use App\Application\Product\DTOs\Category\StoreCategoryDTO;
use App\Application\Product\DTOs\Category\UpdateCategoryDTO;
use App\Domain\Product\Category\Entities\Category;
use Illuminate\Support\Collection;

interface CategoryServiceInterface
{
    public function getAll(): Collection;
    public function create(StoreCategoryDTO $dto): Category;
    public function update(UpdateCategoryDTO $dto): Category;
    public function delete(DeleteCategoryDTO $dto): bool;
}
