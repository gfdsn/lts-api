<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductAvailability
{

    public function __construct(
        private int $stock, // quantity in stock
        private int $availability_id
    ){}

    public function getStock(): int
    {
        return $this->stock;
    }

    public function inStock(): bool{
        return $this->stock > 0; // TODO: improve this up
    }

    public function getAvailabilityId(): int
    {
        return $this->availability_id;
    }

    public function toArray(): array
    {
        return ["stock" => $this->stock, "availability_id" => $this->availability_id];
    }

}
