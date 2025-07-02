<?php

namespace App\Domain\Product\Entities\ValueObjects;

use Illuminate\Support\Str;

readonly class ProductId
{
    private string $value;

    public function __construct()
    {
        $this->value = Str::uuid()->toString();
    }

    public function toString(): string
    {
        return $this->value;
    }
}
