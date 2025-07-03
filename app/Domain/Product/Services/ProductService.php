<?php

namespace App\Domain\Product\Services;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Interfaces\ProductServiceInterface;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Product\Mappers\ProductMapper;
use Illuminate\Support\Collection;

class ProductService implements ProductServiceInterface
{

    public function __construct(
        private ProductRepositoryInterface $productRepository
    ){}

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function create(StoreProductDTO $dto): Product
    {
        $product = ProductMapper::fromDtoToDomain($dto);

        $this->productRepository->save($product);

        return $product;
    }
}
