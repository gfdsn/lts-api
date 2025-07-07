<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Mappers;

use App\Application\DTOInterface;
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

    public static function toDomain(AccessoryModel $accessory): Accessory
    {
        return new Accessory(
            new AccessoryId($accessory->id),
            new AccessoryName($accessory->name),
            new AccessoryDetails($accessory->details),
            new AccessoryPrice($accessory->price),
            new AccessoryStock($accessory->stock),
        );
    }
    public static function fromDtoToDomain(DTOInterface $dto): Accessory
    {
        /* every AccessoryDTO has the same props besides the id */
        $dtoData = $dto->toArray();

        return new Accessory(
            new AccessoryId(),
            new AccessoryName($dtoData['name']),
            new AccessoryDetails($dtoData['details']),
            new AccessoryPrice($dtoData['price']),
            new AccessoryStock($dtoData['stock']),
        );
    }

}
