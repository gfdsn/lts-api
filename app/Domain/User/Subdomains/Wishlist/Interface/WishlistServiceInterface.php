<?php

namespace App\Domain\User\Subdomains\Wishlist\Interface;

use App\Application\User\DTOs\Wishlist\UpdateUserWishlistDTO;
use Illuminate\Support\Collection;

interface WishlistServiceInterface
{
    public function getUserWishlist(): Collection;
    public function addProductToWishlist(UpdateUserWishlistDTO $dto): void;
    public function removeProductFromWishlist(UpdateUserWishlistDTO $dto): void;
}
