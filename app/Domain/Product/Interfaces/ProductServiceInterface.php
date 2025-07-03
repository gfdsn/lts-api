<?php

namespace App\Domain\Product\Interfaces;

use App\Application\Product\DTOs\StoreProductDTO;

interface ProductServiceInterface
{

    public function create(StoreProductDTO $dto);

}
