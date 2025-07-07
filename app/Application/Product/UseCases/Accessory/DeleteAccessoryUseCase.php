<?php

namespace App\Application\Product\UseCases\Accessory;

use App\Application\Product\DTOs\Accessory\DeleteAccessoryDTO;
use App\Domain\Product\Subdomains\Accessory\Interfaces\AccessoryServiceInterface;

readonly class DeleteAccessoryUseCase
{

    public function __construct(
     private AccessoryServiceInterface $accessoryService
    ){}

    public function execute(DeleteAccessoryDTO $dto): void
    {
        $this->accessoryService->delete($dto);
    }

}
