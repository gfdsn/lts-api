<?php

namespace App\Domain\Product\Subdomains\Accessory\Repositories;

use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use Illuminate\Support\Collection;

interface AccessoryRepositoryInterface
{
    public function getAll(): Collection;
    public function find(string $id): AccessoryModel;
    public function save(Accessory $accessory): void;
    public function update(AccessoryModel $accessoryModel, Accessory $updatedAccessoryValues): void;
    public function destroy(string $id): bool;
}
