<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\Cart\AddToCartDTO;
use App\Application\User\DTOs\Cart\RemoveFromCartDTO;
use App\Application\User\UseCases\Cart\AddToCartUseCase;
use App\Application\User\UseCases\Cart\ClearCartUseCase;
use App\Application\User\UseCases\Cart\RemoveFromCartUseCase;
use App\Application\User\UseCases\Cart\RetrieveUserCartUseCase;
use App\Domain\User\Subdomains\Cart\Interfaces\CartServiceInterface;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{

    public function __construct(
        private CartServiceInterface $cartService,
    ){
        $this->middleware('auth:api');
    }

    public function getUserCart(RetrieveUserCartUseCase $useCase): JsonResponse
    {
        $cart = $useCase->execute();
        $cartTotal = $this->cartService->calcCartTotal();

        $resource = (new CartResource($cart))->withTotal($cartTotal);

        return ResponseBuilder::sendData($resource);
    }

    public function addToCart(AddToCartRequest $request, AddToCartUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();
        $dto = new AddToCartDto(...array_values($validated));

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Product added to cart successfully!");
        } catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }
    public function removeFromCart(RemoveFromCartRequest $request, RemoveFromCartUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();
        $dto = new RemoveFromCartDTO(...array_values($validated));

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Product removed from cart successfully!");
        } catch (\Throwable $e) {

            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }
    public function clearCart(ClearCartUseCase $useCase): JsonResponse
    {
        try {

            $useCase->execute();

            return ResponseBuilder::success("Cart cleared successfully!");

        } catch (\Throwable $e){
            return ResponseBuilder::error("There was a server error, please try again later.");
        }
    }

}
