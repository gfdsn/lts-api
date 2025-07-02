<?php

namespace App\Domain\Product\Services;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Interfaces\ProductServiceInterface;
use App\Infrastructure\Persistence\Product\Mappers\ProductMapper;

class ProductService implements ProductServiceInterface
{
    public function create(StoreProductDTO $dto): Product
    {
        return ProductMapper::fromDtoToDomain($dto);
    }
}
