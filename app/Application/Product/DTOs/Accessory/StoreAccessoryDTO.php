<?php

namespace App\Application\Product\DTOs\Accessory;

readonly class StoreAccessoryDTO
{

    public function __construct(
        private string $name,
        private string $details,
        private int $price,
        private int $stock,
        private string $product_id,
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

}
