<?php

namespace App\Application\Product\DTOs\Accessory;

readonly class DeleteAccessoryDTO
{

    public function __construct(
        private string $id,
    ){}

    public function getId(): string
    {
        return $this->id;
    }

}
