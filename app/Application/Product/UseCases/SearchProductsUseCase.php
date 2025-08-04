<?php

namespace App\Application\Product\UseCases;

use App\Domain\Product\Interfaces\ProductServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

readonly class SearchProductsUseCase
{
    public function __construct(
        private ProductServiceInterface $productService
    ){}

    public function execute(?string $searchQuery): Collection|LengthAwarePaginator
    {
        return $this->productService->search($searchQuery);
    }
}
