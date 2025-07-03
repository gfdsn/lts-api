<?php

namespace App\Application\Product\UseCases\Category;

use App\Application\Product\DTOs\Category\DeleteCategoryDTO;
use App\Domain\Product\Category\Interfaces\CategoryServiceInterface;

readonly class DeleteCategoryUseCase
{

    public function __construct(
        private CategoryServiceInterface $categoryService
    ){}

    public function execute(DeleteCategoryDTO $dto): void
    {
        $this->categoryService->delete($dto);
    }

}
