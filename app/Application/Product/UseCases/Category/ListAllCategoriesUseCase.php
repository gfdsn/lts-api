<?php

namespace App\Application\Product\UseCases\Category;

use App\Domain\Product\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Collection;

class ListAllCategoriesUseCase
{

    public function __construct(
        private CategoryServiceInterface $categoryService
    ){}


    public function execute(): Collection
    {
        return $this->categoryService->getAll();
    }

}
