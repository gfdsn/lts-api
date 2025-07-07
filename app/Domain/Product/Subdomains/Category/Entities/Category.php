<?php

namespace App\Domain\Product\Subdomains\Category\Entities;

use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryId;
use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryName;

class Category implements \JsonSerializable
{

    public function __construct(
        private CategoryId $id,
        private CategoryName $name,
    ){}

    public function getId(): string
    {
        return $this->id->getValue();
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function toArray(): array
    {
        return ["id" => $this->id->getValue(), "name" => $this->name->getValue()];
    }

    public function update(string $name): self
    {
        return new self(
            id: $this->id,
            name: new CategoryName($name) ?? $this->name,
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            "name" => $this->name->getValue()
        ];
    }
}
