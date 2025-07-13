<?php

namespace App\Application\Product\DTOs;

readonly class StoreProductDTO
{

    public function __construct(
        private string $title,
        private string $description,
        private array $attributes,
        private array $measures,
        private array $classification,
        private array $quotation,
        private array $images,
        private array $documentation,
        private int $availability_id,
        private int $stock,
        private array $accessories,

    ){}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAttributes(): array
    {
        return [$this->attributes["weight"], $this->attributes["color"]];
    }

    public function getMeasures(): array
    {
        return [$this->measures["length"], $this->measures["width"], $this->measures["height"]];
    }

    public function getCategory(): string
    {
        return $this->classification["category_id"];
    }

    public function getSubCategory(): string
    {
        return $this->classification["subcategory_id"];
    }

    public function getPrice(): int
    {
        return $this->quotation["price"];
    }

    public function getDiscount(): int
    {
        return $this->quotation["discount"];
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getDocumentation(): array
    {
        return $this->documentation;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getAvailabilityId(): int
    {
        return $this->availability_id;
    }

    public function getAccessories(): array
    {
        return $this->accessories;
    }

    public function getColor(): string
    {
        return $this->attributes["color"];
    }

}
