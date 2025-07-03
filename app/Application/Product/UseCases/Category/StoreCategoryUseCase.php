<?php

namespace App\Application\Product\UseCases\Category;

use App\Application\Product\DTOs\Category\StoreCategoryDTO;
use App\Domain\Product\Category\Entities\Category;
use App\Domain\Product\Category\Interfaces\CategoryServiceInterface;

readonly class StoreCategoryUseCase
{

    public function __construct(
        private CategoryServiceInterface $categoryService
    ){}

    public function execute(StoreCategoryDTO $dto): Category
    {

        return $this->categoryService->create($dto);

    }

}
