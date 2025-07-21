<?php

namespace App\Application\User\UseCases\Cart;

use App\Application\User\DTOs\Cart\AddToCartDTO;
use App\Application\User\DTOs\Cart\RemoveFromCartDTO;
use App\Domain\User\Subdomains\Cart\Interfaces\CartServiceInterface;

class RemoveFromCartUseCase
{

    public function __construct(
        private CartServiceInterface $cartService
    ){}


    public function execute(RemoveFromCartDTO $dto): void
    {
        $this->cartService->removeFromCart($dto);
    }

}
