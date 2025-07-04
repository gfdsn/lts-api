<?php

namespace App\Domain\Product\Subdomains\Accessory\Services;


use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use App\Domain\Product\Subdomains\Accessory\Interfaces\AccessoryServiceInterface;
use App\Domain\Product\Subdomains\Accessory\Repositories\AccessoryRepositoryInterface;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Mappers\AccessoryMapper;
use Illuminate\Support\Collection;

class AccessoryService implements AccessoryServiceInterface
{

    public function __construct(
        private AccessoryRepositoryInterface $accessoryRepository
    ){}

    public function getAll(): Collection
    {
        return $this->accessoryRepository->getAll();
    }

    public function create(StoreAccessoryDTO $dto): Accessory
    {
        $accessory = AccessoryMapper::fromStoreDtoToDomain($dto);

        $this->accessoryRepository->save($accessory);

        return $accessory;
    }
}
