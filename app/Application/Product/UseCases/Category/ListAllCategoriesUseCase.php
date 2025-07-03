<?php

namespace App\Application\Product\UseCases\Category;

use App\Domain\Product\Category\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Collection;

readonly class ListAllCategoriesUseCase
{

    public function __construct(
        private CategoryServiceInterface $categoryService
    ){}


    public function execute(): Collection
    {
        return $this->categoryService->getAll();
    }

}
