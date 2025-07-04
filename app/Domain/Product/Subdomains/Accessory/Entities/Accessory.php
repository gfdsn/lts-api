<?php

namespace App\Domain\Product\Subdomains\Accessory\Entities;

use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryDetails;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryId;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryName;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryPrice;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryProduct;
use App\Domain\Product\Subdomains\Accessory\Entities\ValueObjects\AccessoryStock;

class Accessory implements \JsonSerializable
{

    public function __construct(
        public readonly AccessoryId $id,
        public AccessoryName $name,
        public AccessoryDetails $details,
        public AccessoryPrice $price,
        public AccessoryStock $stock,
        public AccessoryProduct $product,
    ){}

    public function getId(): string
    {
        return $this->id->getValue();
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function getDetails(): string
    {
        return $this->details->getValue();
    }

    public function getPrice(): int
    {
        return $this->price->getValue();
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id->getValue(),
            "name" => $this->name->getValue(),
            "details" => $this->details->getValue(),
            "price" => $this->price->getValue(),
            "stock" => $this->stock->getValue(),
            "product_id" => $this->product->getProductId()
        ];

    }
}
