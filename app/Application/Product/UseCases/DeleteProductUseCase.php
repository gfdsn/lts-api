<?php

namespace App\Application\Product\UseCases;

use App\Application\Product\DTOs\DeleteProductDTO;
use App\Domain\Product\Interfaces\ProductServiceInterface;

readonly class DeleteProductUseCase
{

    public function __construct(
        private ProductServiceInterface $productService
    ){}

    public function execute(DeleteProductDTO $dto): void
    {
        $this->productService->delete($dto);
    }


}
