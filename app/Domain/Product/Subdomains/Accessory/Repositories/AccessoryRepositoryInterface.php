<?php

namespace App\Domain\Product\Subdomains\Accessory\Repositories;

use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use Illuminate\Support\Collection;

interface AccessoryRepositoryInterface
{

    public function getAll(): Collection;
    public function save(Accessory $accessory): void;

}
