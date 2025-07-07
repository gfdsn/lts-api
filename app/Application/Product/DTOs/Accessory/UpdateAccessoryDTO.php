<?php

namespace App\Application\Product\DTOs\Accessory;

use App\Application\DTOInterface;

readonly class UpdateAccessoryDTO implements DTOInterface
{
    public function __construct(
        private string $id,
        private string $name,
        private string $details,
        private int $price,
        private int $stock,
        private string $product_id
    ){}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function getPrice(): string
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

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "details" => $this->details,
            "price" => $this->price,
            "stock" => $this->stock,
            "product_id" => $this->product_id
        ];
    }
}
