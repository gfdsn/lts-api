<?php

namespace App\Domain\Product\Subdomains\Category\Entities;

use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryIcon;
use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryId;
use App\Domain\Product\Subdomains\Category\Entities\ValueObjects\CategoryName;

class Category implements \JsonSerializable
{

    public function __construct(
        private CategoryId $id,
        private CategoryName $name,
        private CategoryIcon $icon,
    ){}

    public function getId(): string
    {
        return $this->id->getValue();
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function getIcon(): string
    {
        return $this->icon->getValue();
    }

    public function update(string $name, string $icon): self
    {
        return new self(
            id: $this->id,
            name: new CategoryName($name) ?? $this->name,
            icon: new CategoryIcon($icon) ?? $this->icon
        );
    }

    public function toArray(): array
    {
        return ["id" => $this->id->getValue(), "name" => $this->name->getValue()];
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id->getValue(),
            "name" => $this->name->getValue(),
            "icon" => $this->icon->getValue()
        ];
    }
}
