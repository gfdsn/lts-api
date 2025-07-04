<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Eloquent;

use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use App\Domain\Product\Subdomains\Accessory\Repositories\AccessoryRepositoryInterface;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Mappers\AccessoryMapper;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use Illuminate\Support\Collection;

class AccessoryRepository implements AccessoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return AccessoryModel::all();
    }

    public function save(Accessory $accessory): void
    {
        $accessoryModel = AccessoryMapper::toModel($accessory);

        $accessoryModel->save();
    }
}
