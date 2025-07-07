<?php

namespace App\Domain\Product\Subdomains\Accessory\Services;


use App\Application\Product\DTOs\Accessory\DeleteAccessoryDTO;
use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Application\Product\DTOs\Accessory\UpdateAccessoryDTO;
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
        $accessory = AccessoryMapper::fromDtoToDomain($dto);

        $this->accessoryRepository->save($accessory);

        return $accessory;
    }

    public function update(UpdateAccessoryDTO $dto): Accessory
    {
        $accessoryModel = $this->accessoryRepository->find($dto->getId());
        $accessory = AccessoryMapper::toDomain($accessoryModel);


        $updatedValues = AccessoryMapper::fromDtoToDomain($dto);

        /* update the domain model */
        $updatedAccessory = $accessory->update($updatedValues);
        unset($accessory);

        /* update the db record */
        $this->accessoryRepository->update($accessoryModel, $updatedAccessory);

        return $updatedAccessory;
    }

    public function delete(DeleteAccessoryDTO $dto): bool
    {
        return $this->accessoryRepository->destroy($dto->getId());
    }
}
