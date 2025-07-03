<?php

namespace App\Domain\Product\Entities\ValueObjects;

readonly class ProductMeasure
{
    public function __construct(
        private int $length,
        private int $width,
        private int $height,
    ){}

    public function getLength(): int
    {
        return $this->length;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function toArray()
    {
        return ["length" => $this->length, "width" => $this->width, "height" => $this->height];
    }

}
