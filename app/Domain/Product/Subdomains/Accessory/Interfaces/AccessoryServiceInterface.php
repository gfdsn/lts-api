<?php

namespace App\Domain\Product\Subdomains\Accessory\Interfaces;

use App\Application\Product\DTOs\Accessory\DeleteAccessoryDTO;
use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Application\Product\DTOs\Accessory\UpdateAccessoryDTO;
use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use Illuminate\Support\Collection;

interface AccessoryServiceInterface
{

    public function getAll(): Collection;
    public function create(StoreAccessoryDTO $dto): Accessory;
    public function update(UpdateAccessoryDTO $dto): Accessory;
    public function delete(DeleteAccessoryDTO $dto): bool;

}
