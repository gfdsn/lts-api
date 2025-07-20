<?php

namespace App\Domain\User\Subdomains\Wishlist\Services;

use App\Application\User\DTOs\Wishlist\UpdateUserWishlistDTO;
use App\Domain\Product\Interfaces\ProductServiceInterface;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Domain\User\Subdomains\Wishlist\Interface\WishlistServiceInterface;
use Illuminate\Support\Collection;

class WishlistService implements WishlistServiceInterface
{

    public function __construct(
        private ProductServiceInterface $productService,
        private UserServiceInterface $userService
    ){}

    public function getUserWishlist(): Collection
    {
        $user = auth()->user();

        return $user->wishlist;
    }

    public function addProductToWishlist(UpdateUserWishlistDTO $dto): void
    {
        $user = $this->userService->find($dto->getUserId());
        $product = $this->productService->findById($dto->getProductId());

        $user->wishlist()->attach($product);
    }

    public function removeProductFromWishlist(UpdateUserWishlistDTO $dto): void
    {
        $user = $this->userService->find($dto->getUserId());
        $product = $this->productService->findById($dto->getProductId());

        $user->wishlist()->detach($product);
    }
}
