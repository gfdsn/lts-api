<?php

namespace App\Application\User\UseCases\Cart;

use App\Application\User\DTOs\Cart\AddToCartDTO;
use App\Domain\User\Subdomains\Cart\Interfaces\CartServiceInterface;

class AddToCartUseCase
{

    public function __construct(
        private CartServiceInterface $cartService
    ){}


    public function execute(AddToCartDTO $dto): void
    {
        $this->cartService->addToCart($dto);
    }

}
