<?php

namespace App\Domain\Product\Services;

use App\Application\Product\DTOs\DeleteProductDTO;
use App\Application\Product\DTOs\StoreProductDTO;
use App\Application\Product\DTOs\UpdateProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Interfaces\ProductServiceInterface;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Product\Mappers\ProductMapper;
use App\Infrastructure\Persistence\Product\Models\ProductModel;
use Illuminate\Support\Collection;

class ProductService implements ProductServiceInterface
{

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ){}

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function find(string $slug): ProductModel
    {
        return $this->productRepository->findBySlug($slug);
    }

    public function create(StoreProductDTO $dto): Product
    {
        $product = ProductMapper::fromStoreDtoToDomain($dto);

        $this->productRepository->save($product);

        return $product;
    }

    public function update(UpdateProductDTO $dto): Product
    {
        $productModel = $this->productRepository->find($dto->getId());
        $product = ProductMapper::toDomain($productModel);

        $updatedValues = $dto->toArray();

        /* updated the domain obj */
        $updatedProduct = $product->update($updatedValues);
        unset($product);

        /* update the record in the database*/
        $this->productRepository->update($productModel, $updatedProduct);

        return $updatedProduct;
    }

    public function delete(DeleteProductDTO $dto): bool
    {
       return $this->productRepository->destroy($dto->getId());
    }

    public function getRandomProductCount(int $count): Collection
    {
        return $this->productRepository->random($count);
    }
}
