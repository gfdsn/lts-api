<?php

namespace App\Domain\Product\Exceptions;

class ProductRepositoryException extends \Exception
{

    public static function notFound(): self
    {
        return new self("The given product was not found.");
    }

}
