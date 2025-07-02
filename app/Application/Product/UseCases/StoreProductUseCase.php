<?php

namespace App\Application\Product\UseCases;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Interfaces\ProductServiceInterface;

readonly class StoreProductUseCase
{

    public function __construct(
        private ProductServiceInterface $productService
    ) {}

    public function execute(StoreProductDTO $dto): Product
    {
        return $this->productService->create($dto);
    }

}
