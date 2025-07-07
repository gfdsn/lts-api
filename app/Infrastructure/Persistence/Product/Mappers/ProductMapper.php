<?php

namespace App\Infrastructure\Persistence\Product\Mappers;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ValueObjects\ProductAccessories;
use App\Domain\Product\Entities\ValueObjects\ProductAttribute;
use App\Domain\Product\Entities\ValueObjects\ProductClassification;
use App\Domain\Product\Entities\ValueObjects\ProductDescription;
use App\Domain\Product\Entities\ValueObjects\ProductDocumentation;
use App\Domain\Product\Entities\ValueObjects\ProductId;
use App\Domain\Product\Entities\ValueObjects\ProductImage;
use App\Domain\Product\Entities\ValueObjects\ProductMeasure;
use App\Domain\Product\Entities\ValueObjects\ProductPrice;
use App\Domain\Product\Entities\ValueObjects\ProductAvailability;
use App\Domain\Product\Entities\ValueObjects\ProductTitle;
use App\Infrastructure\Persistence\Product\Models\ProductModel;

class ProductMapper
{
    public static function toModel(Product $product): ProductModel
    {
        return new ProductModel([
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'description' => $product->getDescription(),
            'attributes' => $product->getAttributes(),
            'measures' => $product->getMeasures(),
            'classification' => $product->getClassification(),
            'price' => $product->getPrice(),
            'images' => $product->getImages(),
            'documentation' => $product->getDocumentation(),
            'availability' => $product->getAvailability(),
            'accessories' => $product->getAccessories(),
        ]);
    }
    public static function toDomain(ProductModel $model): Product
    {
        return new Product(
            new ProductId(),
            new ProductTitle($model->title),
            new ProductDescription($model->description),
            new ProductAttribute(...$model->attributes),
            new ProductMeasure(...$model->measures),
            new ProductClassification($model->classification["category_id"], $model->classification["subcategory_id"]),
            new ProductPrice($model->price),
            new ProductImage($model->images),
            new ProductDocumentation($model->documentation),
            new ProductAvailability($model->stock),
            new ProductAccessories($model->accessories),
        );
    }

    public static function fromStoreDtoToDomain(StoreProductDTO $dto): Product
    {
        return new Product(
            new ProductId(),
            new ProductTitle($dto->getTitle()),
            new ProductDescription($dto->getDescription()),
            new ProductAttribute(...$dto->getAttributes()),
            new ProductMeasure(...$dto->getMeasures()),
            new ProductClassification($dto->getCategory(), $dto->getSubCategory()),
            new ProductPrice($dto->getPrice()),
            new ProductImage($dto->getImages()),
            new ProductDocumentation($dto->getDocumentation()),
            new ProductAvailability($dto->getStock(), $dto->getAvailabilityId()),
            new ProductAccessories($dto->getAccessories()),
        );
    }
}
