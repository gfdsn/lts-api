<?php

namespace App\Domain\Product\Subdomains\Category\Services;

use App\Application\Product\DTOs\Category\DeleteCategoryDTO;
use App\Application\Product\DTOs\Category\StoreCategoryDTO;
use App\Application\Product\DTOs\Category\UpdateCategoryDTO;
use App\Domain\Product\Subdomains\Category\Entities\Category;
use App\Domain\Product\Subdomains\Category\Interfaces\CategoryServiceInterface;
use App\Domain\Product\Subdomains\Category\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Mappers\CategoryMapper;
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
        $category = CategoryMapper::fromStoreDtoToDomain($dto);

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
