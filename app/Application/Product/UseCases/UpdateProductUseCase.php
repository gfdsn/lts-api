<?php

namespace App\Application\Product\UseCases;

use App\Application\Product\DTOs\UpdateProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Interfaces\ProductServiceInterface;

class UpdateProductUseCase
{

    public function __construct(
        private ProductServiceInterface $productService
    ){}

    public function execute(UpdateProductDTO $dto): Product
    {
        return $this->productService->update($dto);
    }

}
