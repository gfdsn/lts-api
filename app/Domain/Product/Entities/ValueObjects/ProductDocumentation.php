<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductDocumentation
{

    /* product's file documentation url paths */

    public function __construct(
        private array $docs
    ){}

    public function getDocs(): array
    {
        return $this->docs;
    }

}
