<?php

namespace App\Application\Product\UseCases\Category;

use App\Domain\Product\Subdomains\Category\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Collection;

readonly class GetRandomCategoryCountUseCase
{

    public function __construct(
        private CategoryServiceInterface $categoryService
    ){}

    public function execute(int $count): Collection
    {
        return $this->categoryService->getRandomCategoryCount($count);
    }
}
