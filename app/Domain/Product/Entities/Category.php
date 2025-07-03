<?php

namespace App\Domain\Product\Entities;

use App\Domain\Product\Entities\ValueObjects\Category\CategoryId;
use App\Domain\Product\Entities\ValueObjects\Category\CategoryName;

class Category
{
    private CategoryId $id;
    private CategoryName $name;

    public function __construct(
        private string $value
    ){
        $this->id = new CategoryId();
        $this->name = new CategoryName($this->value);
    }

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
}
