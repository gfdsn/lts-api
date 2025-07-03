<?php

namespace App\Domain\Product\Entities;

use App\Domain\Product\Entities\ValueObjects\ProductAccessories;
use App\Domain\Product\Entities\ValueObjects\ProductAttribute;
use App\Domain\Product\Entities\ValueObjects\ProductClassification;
use App\Domain\Product\Entities\ValueObjects\ProductPrice;
use App\Domain\Product\Entities\ValueObjects\ProductDescription;
use App\Domain\Product\Entities\ValueObjects\ProductDocumentation;
use App\Domain\Product\Entities\ValueObjects\ProductId;
use App\Domain\Product\Entities\ValueObjects\ProductImage;
use App\Domain\Product\Entities\ValueObjects\ProductMeasure;
use App\Domain\Product\Entities\ValueObjects\ProductStock;
use App\Domain\Product\Entities\ValueObjects\ProductTitle;

class Product implements \JsonSerializable
{

    public function __construct(
        private readonly ProductId $id,
        public ProductTitle $title,
        public ProductDescription $description,
        public ProductAttribute $attributes, // weight, color
        public ProductMeasure $measures, // width, length, height
        public ProductClassification $classification, // category, subcategory
        public ProductPrice $price, // price, shipping price
        public ProductImage $images,
        public ProductDocumentation $documentation,
        public ProductStock $stock,
        public ProductAccessories  $accessories, // available accessories for a product
    ){}

    public function getId(): string
    {
        return  $this->id->toString();
    }

    public function getTitle(): string
    {
        return $this->title->value();
    }

    public function getDescription(): string
    {
        return $this->description->value();
    }

    public function getAttributes(): array
    {
        return $this->attributes->toArray();
    }

    public function getMeasures(): array
    {
        return $this->measures->toArray();
    }

    public function getClassification(): array
    {
        return $this->classification->toArray();
    }

    public function getPrice(): int
    {
        return $this->price->getValue();
    }

    public function getImages(): array
    {
        return $this->images->getImages();
    }

    public function getDocumentation(): array
    {
        return $this->documentation->getDocs();
    }

    public function getStock(): int
    {
        return $this->stock->getQuantity();
    }

    public function getAccessories(): array
    {
        return $this->accessories->getAccessories();
    }

    public function update(){}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->toString(),
            'title' => $this->title->value(),
            'description' => $this->description->value(),
            'attributes' => $this->attributes->toArray(),
            'measures' => $this->measures->toArray(),
            'classification' => $this->classification->toArray(),
            'costs' => $this->price->getValue(),
            'images' => $this->images->getImages(),
            'documentation' => $this->documentation->getDocs(),
            'stock' => $this->stock->getQuantity(),
            'accessories' => $this->accessories->getAccessories(),
        ];
    }


}
