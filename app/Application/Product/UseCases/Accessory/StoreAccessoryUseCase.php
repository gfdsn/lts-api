<?php

namespace App\Application\Product\UseCases\Accessory;

use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use App\Domain\Product\Subdomains\Accessory\Interfaces\AccessoryServiceInterface;

readonly class StoreAccessoryUseCase
{
    public function __construct(
        private AccessoryServiceInterface $accessoryService
    ){}

    public function execute(StoreAccessoryDTO $dto): Accessory
    {
        return $this->accessoryService->create($dto);
    }

}
