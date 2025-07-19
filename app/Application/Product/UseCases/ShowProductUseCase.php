<?php

namespace App\Application\Product\UseCases;

use App\Application\Product\DTOs\ShowProductDTO;
use App\Domain\Product\Interfaces\ProductServiceInterface;
use App\Infrastructure\Persistence\Product\Models\ProductModel;

readonly class ShowProductUseCase
{

    public function __construct(
        private ProductServiceInterface $productService
    ){}

    public function execute(ShowProductDTO $dto): ProductModel
    {
        return $this->productService->find($dto->getSlug());
    }
}
