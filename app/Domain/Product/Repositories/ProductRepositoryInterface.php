<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;
}
