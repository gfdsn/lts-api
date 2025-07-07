<?php

namespace App\Application\Product\UseCases\Accessory;

use App\Application\Product\DTOs\Accessory\UpdateAccessoryDTO;
use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use App\Domain\Product\Subdomains\Accessory\Interfaces\AccessoryServiceInterface;

readonly class UpdateAccessoryUseCase
{

    public function __construct(
        private AccessoryServiceInterface $accessoryService
    ){}

    public function execute(UpdateAccessoryDTO $dto): Accessory
    {
        return $this->accessoryService->update($dto);
    }

}
