<?php

namespace App\Application\Product\DTOs;

readonly class DeleteProductDTO
{

    public function __construct(
        private string $id,
    ){}

    public function getId(): string
    {
        return $this->id;
    }

}
