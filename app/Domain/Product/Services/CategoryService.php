<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryService
{

    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

}
