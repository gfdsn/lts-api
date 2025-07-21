<?php

namespace App\Application\User\UseCases\Cart;

use App\Domain\User\Subdomains\Cart\Interfaces\CartServiceInterface;

class ClearCartUseCase
{

    public function __construct(
        private CartServiceInterface $cartService
    ){}

    public function execute(): void
    {
        $this->cartService->emptyCart();
    }
}
