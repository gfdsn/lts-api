<?php

namespace App\Http\Controllers;

use App\Application\Product\DTOs\DeleteProductDTO;
use App\Application\Product\DTOs\StoreProductDTO;
use App\Application\Product\DTOs\UpdateProductDTO;
use App\Application\Product\UseCases\DeleteProductUseCase;
use App\Application\Product\UseCases\GetRandomProductCountUseCase;
use App\Application\Product\UseCases\ListAllProductsUseCase;
use App\Application\Product\UseCases\StoreProductUseCase;
use App\Application\Product\UseCases\UpdateProductUseCase;
use App\Http\Middleware\VerifyIfUserIsAdmin;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\RandomProductCountRequest;
use App\Http\Resources\ProductResource;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(VerifyIfUserIsAdmin::class)->except('randomProductCount');
    }

    public function index(ListAllProductsUseCase $useCase): JsonResponse
    {
        $products = $useCase->execute();

        return ResponseBuilder::sendData(ProductResource::collection($products));
    }

    public function store(StoreProductRequest $request, StoreProductUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();
        $dto = new StoreProductDTO(...array_values($validated));

        try {
            $product = $useCase->execute($dto);

            return ResponseBuilder::sendData($product, 201);
        } catch (\Throwable $e) {

            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function update(UpdateProductRequest $request, UpdateProductUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new UpdateProductDTO(...array_values($validated));


        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Product updated successfully.");
        } catch (\Throwable $e) {
            return ResponseBuilder::error($e->getMessage(), 500);
//            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

    }

    public function delete(DeleteProductRequest $request, DeleteProductUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new DeleteProductDTO($validated["id"]);

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Product deleted successfully.");
        } catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

    }

    public function randomProductCount(RandomProductCountRequest $request, GetRandomProductCountUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        try {

            $products = $useCase->execute($validated["count"]);

            return ResponseBuilder::sendData(ProductResource::collection($products));
        }catch (\Throwable $e) {

            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

}
