<?php

namespace App\Domain\Product\Entities\ValueObjects\Category;

use Illuminate\Support\Str;

class CategoryId
{

    private string $value;

    public function __construct()
    {
        $this->value = Str::uuid()->toString();
    }

    public function getValue(): string
    {
        return $this->value;
    }

}
