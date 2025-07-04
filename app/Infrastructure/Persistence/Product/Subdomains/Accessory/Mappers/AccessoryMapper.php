<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Mappers;

use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Domain\Product\Subdomains\Accessory\Entities\Accessory;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryDetails;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryId;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryName;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryPrice;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryProduct;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryStock;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;

class AccessoryMapper
{

    public static function toModel(Accessory $accessory): AccessoryModel
    {
        return new AccessoryModel($accessory->jsonSerialize());
    }

    public static function fromStoreDtoToDomain(StoreAccessoryDTO $dto): Accessory
    {
        return new Accessory(
            new AccessoryId(),
            new AccessoryName($dto->getName()),
            new AccessoryDetails($dto->getDetails()),
            new AccessoryPrice($dto->getPrice()),
            new AccessoryStock($dto->getStock()),
            new AccessoryProduct($dto->getProductId())
        );
    }

}
