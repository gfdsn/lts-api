<?php

namespace App\Application\Product\UseCases\Accessory;

use App\Domain\Product\Subdomains\Accessory\Interfaces\AccessoryServiceInterface;
use Illuminate\Support\Collection;

readonly class ListAllAccessoriesUseCase
{

    public function __construct(
        private AccessoryServiceInterface $accessoryService
    ){}

    public function execute(): Collection
    {
        return $this->accessoryService->getAll();
    }

}
