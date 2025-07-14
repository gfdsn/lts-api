<?php

namespace App\Domain\Product\Interfaces;

use App\Application\Product\DTOs\DeleteProductDTO;
use App\Application\Product\DTOs\StoreProductDTO;
use App\Application\Product\DTOs\UpdateProductDTO;
use App\Domain\Product\Entities\Product;
use Illuminate\Support\Collection;

interface ProductServiceInterface
{

    public function getAll(): Collection;
    public function create(StoreProductDTO $dto): Product;
    public function update(UpdateProductDTO $dto): Product;
    public function delete(DeleteProductDTO $dto): bool;
    public function getRandomProductCount(int $count): Collection;
}
