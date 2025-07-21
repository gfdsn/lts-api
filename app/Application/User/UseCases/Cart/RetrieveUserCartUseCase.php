<?php

namespace App\Application\User\UseCases\Cart;

use App\Domain\User\Subdomains\Cart\Interfaces\CartServiceInterface;
use Illuminate\Support\Collection;

class RetrieveUserCartUseCase
{

    public function __construct(
        private CartServiceInterface $cartService
    ){}

    public function execute(): Collection
    {
        return $this->cartService->getUserCart();
    }

}
