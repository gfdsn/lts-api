<?php

namespace App\Domain\Product\Subdomains\Category\Entities\ValueObjects;

use Illuminate\Support\Str;

class CategoryId
{

    public function __construct(
        private ?string $value = null
    ){
        $this->value = $this->value ?? Str::uuid()->toString();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
