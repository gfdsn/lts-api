<?php

namespace App\Domain\User\Subdomains\Cart\Services;

use App\Application\User\DTOs\Cart\AddToCartDTO;
use App\Application\User\DTOs\Cart\RemoveFromCartDTO;
use App\Domain\Product\Interfaces\ProductServiceInterface;
use App\Domain\User\Subdomains\Cart\Interfaces\CartServiceInterface;
use Illuminate\Support\Collection;

class CartService implements CartServiceInterface
{

    public function __construct(
        private ProductServiceInterface $productService
    ){}

    public function getUserCart(): Collection
    {
        $user = auth()->user();

        return $user->cart;
    }

    public function addToCart(AddToCartDTO $dto): void
    {
        $user = auth()->user();
        $product  = $this->productService->findById($dto->getProductId());

        $user->cart()->attach($product, ["quantity" => $dto->getQuantity()]);
    }

    public function removeFromCart(RemoveFromCartDTO $dto): void
    {
        $user = auth()->user();
        $product  = $this->productService->findById($dto->getProductId());

        $user->cart()->detach($product);
    }

    public function emptyCart(): void
    {
        $user = auth()->user();

        foreach ($user->cart as $product) {
            $user->cart()->detach($product);
        }
    }

    public function calcCartTotal(): float
    {
        $user = auth()->user();

        return $user->cart->sum(function ($product) {
            $quantity = $product->pivot->quantity ?? 1;
            $price = $product->quotation["price"] / 100 ?? 0;
            $discount_value = max($product->quotation["discount_value"], 0) / 100;

            $finalPrice = $price - ($price * $discount_value);

            return number_format($finalPrice * $quantity, 2, ".", ".");
        });
    }
}
