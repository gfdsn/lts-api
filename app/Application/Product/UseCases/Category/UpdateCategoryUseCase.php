<?php

namespace App\Application\Product\UseCases\Category;

use App\Application\Product\DTOs\Category\UpdateCategoryDTO;
use App\Domain\Product\Subdomains\Category\Interfaces\CategoryServiceInterface;

readonly class UpdateCategoryUseCase
{

    public function __construct(
        private CategoryServiceInterface $categoryService
    ){}

    public function execute(UpdateCategoryDTO $dto): void
    {
        $this->categoryService->update($dto);
    }
}
