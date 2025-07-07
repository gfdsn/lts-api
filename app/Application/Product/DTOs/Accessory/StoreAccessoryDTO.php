<?php

namespace App\Application\Product\DTOs\Accessory;

use App\Application\DTOInterface;

readonly class StoreAccessoryDTO implements DTOInterface
{

    public function __construct(
        private string $name,
        private string $details,
        private int $price,
        private int $stock,
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

    public function toArray(): array
    {
        return ["name" => $this->name, "details" => $this->details, "price" => $this->price, "stock" => $this->stock];
    }
}
