<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\Wishlist\UpdateUserWishlistDTO;
use App\Application\User\UseCases\Wishlist\AddProductToWishlistUseCase;
use App\Application\User\UseCases\Wishlist\RemoveProductToWishlistUseCase;
use App\Application\User\UseCases\Wishlist\RetrieveUserWishlistUseCase;
use App\Http\Requests\User\Wishlist\UpdateUserWishlistRequest;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUserWishlist(RetrieveUserWishlistUseCase $useCase): JsonResponse
    {
        return ResponseBuilder::sendData($useCase->execute());
    }

    public function addProductToWishlist(UpdateUserWishlistRequest $request, AddProductToWishlistUseCase $useCase): JsonResponse
    {

        $validated = $request->validated();
        $dto = new UpdateUserWishlistDTO(...array_values($validated));

        try {

            $useCase->execute($dto);

            return ResponseBuilder::success("Product added to wishlist successfully.");

        } catch (\Throwable $e){

            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function removeProductToWishlist(UpdateUserWishlistRequest $request, RemoveProductToWishlistUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();
        $dto = new UpdateUserWishlistDTO(...array_values($validated));

        try {

            $useCase->execute($dto);

            return ResponseBuilder::success("Product removed from wishlist successfully.");

        } catch (\Throwable $e){

            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

}
