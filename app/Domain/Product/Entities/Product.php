<?php

namespace App\Domain\Product\Entities;

use App\Domain\Product\Entities\ValueObjects\ProductAccessories;
use App\Domain\Product\Entities\ValueObjects\ProductAttribute;
use App\Domain\Product\Entities\ValueObjects\ProductClassification;
use App\Domain\Product\Entities\ValueObjects\ProductCost;
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
        public ProductCost $costs, // price, shipping price
        public ProductImage $images,
        public ProductDocumentation $documentation,
        public ProductStock $stock,
        public ProductAccessories  $accessories, // available accessories for a product
    ){}

    public function getId(): ProductId
    {
        return  $this->id;
    }

    public function getTitle(): ProductTitle
    {
        return $this->title;
    }

    public function getDescription(): ProductDescription
    {
        return $this->description;
    }

    public function getAttributes(): ProductAttribute
    {
        return $this->attributes;
    }

    public function getMeasures(): ProductMeasure
    {
        return $this->measures;
    }

    public function getClassification(): ProductClassification
    {
        return $this->classification;
    }

    public function getCosts(): ProductCost
    {
        return $this->costs;
    }

    public function getImages(): ProductImage
    {
        return $this->images;
    }

    public function getDocumentation(): ProductDocumentation
    {
        return $this->documentation;
    }

    public function getStock(): ProductStock
    {
        return $this->stock;
    }

    public function getAccessories(): ProductAccessories
    {
        return $this->accessories;
    }

    public function update(){}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->toString(),
            'title' => $this->title->value(),
            'description' => $this->description->value(),
            'attributes' => $this->attributes->toArray(), // e.g., ['weight' => ..., 'color' => ...]
            'measures' => $this->measures->toArray(),     // e.g., ['width' => ..., 'length' => ..., 'height' => ...]
            'classification' => $this->classification->toArray(), // ['category' => ..., 'subcategory' => ...]
            'costs' => $this->costs->toArray(),           // ['price' => ..., 'shipping_price' => ...]
            'images' => $this->images->getImages(),         // e.g., list of URLs or paths
            'documentation' => $this->documentation->getDocs(), // e.g., ['manual' => ..., 'specs' => ...]
            'stock' => $this->stock->getQuantity(),           // e.g., ['quantity' => ..., 'status' => ...]
            'accessories' => $this->accessories->getAccessories(), // e.g., ['charger', 'case', ...]
        ];
    }


}
