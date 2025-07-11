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
use App\Domain\Product\Entities\ValueObjects\ProductAvailability;
use App\Domain\Product\Entities\ValueObjects\ProductStock;
use App\Domain\Product\Entities\ValueObjects\ProductTitle;

class Product implements \JsonSerializable
{

    public function __construct(
        private readonly ProductId $id,
        private ProductTitle $title,
        private ProductDescription $description,
        private ProductAttribute $attributes, // weight, color
        private ProductMeasure $measures, // width, length, height
        private ProductClassification $classification, // category_id, subcategory_id
        private ProductPrice $price, // price, shipping price
        private ProductImage $images,
        private ProductDocumentation $documentation,
        private ProductAvailability $availability,
        private ProductStock $stock,
        private ProductAccessories  $accessories,// available accessories for a product
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

    public function getAvailability(): int
    {
        return $this->availability->getValue();
    }

    public function getStock(): int
    {
        return $this->stock->getValue();
    }

    public function getAccessories(): array
    {
        return $this->accessories->getAccessories();
    }

    public function update(array $updatedValues): self
    {
        return new self(
            id: $this->id,
            title: new ProductTitle($updatedValues['title']) ?? $this->title,
            description: new ProductDescription($updatedValues['description']) ?? $this->description,
            attributes: new ProductAttribute(...$updatedValues['attributes']) ?? $this->attributes,
            measures: new ProductMeasure(...$updatedValues['measures']) ?? $this->measures,
            classification: new ProductClassification(...$updatedValues['classification']) ?? $this->classification,
            price: new ProductPrice($updatedValues['price']) ?? $this->price,
            images: new ProductImage($updatedValues['images']) ?? $this->images,
            documentation: new ProductDocumentation($updatedValues['documentation']) ?? $this->documentation,
            availability: new ProductAvailability($updatedValues['availability_id']) ?? $this->availability,
            stock: new ProductStock($updatedValues['stock']) ?? $this->stock,
            accessories: new ProductAccessories($updatedValues['accessories']) ?? $this->accessories,
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->toString(),
            'title' => $this->title->value(),
            'description' => $this->description->value(),
            'attributes' => $this->attributes->toArray(),
            'measures' => $this->measures->toArray(),
            'classification' => $this->classification->toArray(),
            'price' => $this->price->getValue(),
            'images' => $this->images->getImages(),
            'documentation' => $this->documentation->getDocs(),
            'availability' => $this->availability->getValue(),
            'stock' => $this->stock->getValue(),
            'accessories' => $this->accessories->getAccessories(),
        ];
    }

}
