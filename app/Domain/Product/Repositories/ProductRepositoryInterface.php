<?php

namespace App\Domain\Product\Repositories;

use App\Application\Product\DTOs\RandomProductCountDTO;
use App\Domain\Product\Entities\Product;
use App\Infrastructure\Persistence\Product\Models\ProductModel;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function getAll(): Collection;
    public function save(Product $product): void;
    public function find(string $id): ProductModel;
    public function update(ProductModel $productModel, Product $updatedProduct): void;
    public function destroy(string $id): bool;
    public function random(int $count): Collection;
}
