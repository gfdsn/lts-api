<?php

namespace App\Application\Product\UseCases;

use App\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Collection;

readonly class ListAllProductsUseCase
{

    public function __construct(
        private ProductRepositoryInterface $productRepository
    ){}

    public function execute(): Collection
    {
        return $this->productRepository->getAll();
    }

}
