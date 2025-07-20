<?php

namespace App\Application\User\UseCases\Wishlist;

use App\Domain\User\Subdomains\Wishlist\Interface\WishlistServiceInterface;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RetrieveUserWishlistUseCase
{

    public function __construct(
        private WishlistServiceInterface $wishlistService
    ){}

    public function execute(): ResourceCollection
    {
        return ProductResource::collection($this->wishlistService->getUserWishlist());
    }
}
