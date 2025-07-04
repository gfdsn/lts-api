<?php

namespace App\Domain\Product\Subdomains\Accessory\Interfaces;

use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use Illuminate\Support\Collection;

interface AccessoryServiceInterface
{

    public function getAll(): Collection;
    public function create(StoreAccessoryDTO $dto): Accessory;

}
