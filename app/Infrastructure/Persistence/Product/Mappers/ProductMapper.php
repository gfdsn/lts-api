<?php

namespace App\Infrastructure\Persistence\Product\Mappers;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ValueObjects\ProductAccessories;
use App\Domain\Product\Entities\ValueObjects\ProductAttribute;
use App\Domain\Product\Entities\ValueObjects\ProductCategory;
use App\Domain\Product\Entities\ValueObjects\ProductClassification;
use App\Domain\Product\Entities\ValueObjects\ProductPrice;
use App\Domain\Product\Entities\ValueObjects\ProductDescription;
use App\Domain\Product\Entities\ValueObjects\ProductDocumentation;
use App\Domain\Product\Entities\ValueObjects\ProductId;
use App\Domain\Product\Entities\ValueObjects\ProductImage;
use App\Domain\Product\Entities\ValueObjects\ProductMeasure;
use App\Domain\Product\Entities\ValueObjects\ProductStock;
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
            'stock' => $product->getStock(),
            'accessories' => $product->getAccessories(),
        ]);
    }

    public static function fromDtoToDomain(StoreProductDTO $dto): Product
    {
        return new Product(
            new ProductId(),
            new ProductTitle("Product example"),
            new ProductDescription("Product description"),
            new ProductAttribute("100", "red"),
            new ProductMeasure("100", "100", "100"),
            new ProductClassification(new ProductCategory("Test category"), new ProductCategory("Test subcategory")),
            new ProductPrice("30"),
            new ProductImage(["image1", "image2", "image3"]),
            new ProductDocumentation(["pdf1", "pdf2", "pdf3"]),
            new ProductStock("30"),
            new ProductAccessories(["accessories1", "accessories2"]),
        );
    }

}
