<?php

namespace App\Application\Product\UseCases;

use App\Domain\Product\Interfaces\ProductServiceInterface;
use Illuminate\Support\Collection;

readonly class GetRandomProductCountUseCase
{

    public function __construct(
        private ProductServiceInterface $productService
    ){}

    public function execute(int $count): Collection
    {
        return $this->productService->getRandomProductCount($count);
    }

}
