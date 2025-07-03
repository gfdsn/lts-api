<?php

namespace App\Application\Product\UseCases;

use App\Domain\Product\Interfaces\ProductServiceInterface;
use Illuminate\Support\Collection;

readonly class ListAllProductsUseCase
{

    public function __construct(
        private ProductServiceInterface $productService
    ){}

    public function execute(): Collection
    {
        return $this->productService->getAll();
    }

}
