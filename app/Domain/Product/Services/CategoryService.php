<?php

namespace App\Domain\Product\Services;

use App\Application\Product\DTOs\Category\DeleteCategoryDTO;
use App\Application\Product\DTOs\Category\StoreCategoryDTO;
use App\Application\Product\DTOs\Category\UpdateCategoryDTO;
use App\Domain\Product\Entities\Category;
use App\Domain\Product\Interfaces\CategoryServiceInterface;
use App\Domain\Product\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\Product\Mappers\CategoryMapper;
use Illuminate\Support\Collection;

class CategoryService implements CategoryServiceInterface
{

    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function create(StoreCategoryDTO $dto): Category
    {
        $category = CategoryMapper::fromDtoToDomain($dto);

        $this->categoryRepository->save($category);

        return $category;
    }

    public function update(UpdateCategoryDTO $dto): Category
    {
        $categoryModel = $this->categoryRepository->find($dto->getId());
        $category = CategoryMapper::toDomain($categoryModel);

        /* update domain obj */
        $updatedCategory = $category->update($dto->getName());
        unset($category);

        /* updated the db record */
        $this->categoryRepository->update($categoryModel, $updatedCategory);

        return $updatedCategory;
    }


    public function delete(DeleteCategoryDTO $dto): bool
    {
        return $this->categoryRepository->destroy($dto->getId());
    }
}
