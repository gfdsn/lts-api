<?php

namespace App\Domain\User\Subdomains\Cart\Interfaces;

use App\Application\User\DTOs\Cart\AddToCartDTO;
use App\Application\User\DTOs\Cart\RemoveFromCartDTO;
use App\Http\Resources\CartResource;
use Illuminate\Support\Collection;

interface CartServiceInterface
{
    public function getUserCart(): Collection;
    public function addToCart(AddToCartDTO $dto): void;
    public function removeFromCart(RemoveFromCartDTO $dto): void;
    public function emptyCart(): void;
    public function calcCartTotal(): float;
}
