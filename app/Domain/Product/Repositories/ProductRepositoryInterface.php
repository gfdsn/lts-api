<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function getAll(): Collection;
    public function save(Product $product): void;
}
