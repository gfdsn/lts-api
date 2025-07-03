<?php

namespace App\Application\Product\DTOs;

readonly class UpdateProductDTO
{

    public function __construct(
        private string $id,
        private string $title,
        private string $description,
        private array $attributes,
        private array $measures,
        private array $classification,
        private int $price,
        private array $images,
        private array $documentation,
        private int $stock,
        private array $accessories,

    ){}

    public function getId(): string
    {
        return $this->id;
    }



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
        return $this->price;
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

    public function getAccessories(): array
    {
        return $this->accessories;
    }

    public function getColor(): string
    {
        return $this->attributes->color;
    }


    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'attributes' => $this->attributes,
            'measures' => $this->measures,
            'classification' => $this->classification,
            'price' => $this->price,
            'images' => $this->images,
            'documentation' => $this->documentation,
            'stock' => $this->stock,
            'accessories' => $this->accessories,
        ];
    }

}
