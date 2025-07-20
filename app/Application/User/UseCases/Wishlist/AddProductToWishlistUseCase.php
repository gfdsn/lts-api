<?php

namespace App\Application\User\UseCases\Wishlist;

use App\Application\User\DTOs\Wishlist\UpdateUserWishlistDTO;
use App\Domain\User\Subdomains\Wishlist\Interface\WishlistServiceInterface;

class AddProductToWishlistUseCase
{

    public function __construct(
        private WishlistServiceInterface $wishlistService
    ){}

    public function execute(UpdateUserWishlistDTO $dto): void
    {
        $this->wishlistService->addProductToWishlist($dto);
    }

}
