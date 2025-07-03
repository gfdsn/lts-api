<?php

namespace App\Domain\Product\Interfaces;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Domain\Product\Entities\Product;
use Illuminate\Support\Collection;

interface ProductServiceInterface
{

    public function getAll(): Collection;
    public function create(StoreProductDTO $dto): Product;

}
