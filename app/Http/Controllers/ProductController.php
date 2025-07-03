<?php

namespace App\Http\Controllers;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Application\Product\DTOs\UpdateProductDTO;
use App\Application\Product\UseCases\ListAllProductsUseCase;
use App\Application\Product\UseCases\StoreProductUseCase;
use App\Application\Product\UseCases\UpdateProductUseCase;
use App\Http\Middleware\VerifyIfUserIsAdmin;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(VerifyIfUserIsAdmin::class);
    }

    public function index(ListAllProductsUseCase $useCase): JsonResponse
    {
        $products = $useCase->execute();

        return ResponseBuilder::sendData($products);
    }

    public function store(StoreProductRequest $request, StoreProductUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();
        $dto = new StoreProductDTO(...array_values($validated));

        $product = $useCase->execute($dto);

        return ResponseBuilder::sendData($product, 201);
    }

    public function update(UpdateProductRequest $request, UpdateProductUseCase $useCase)
    {

        $validated = $request->validated();

        $dto = new UpdateProductDTO(...array_values($validated));

        $updatedProduct = $useCase->execute($dto);

        return ResponseBuilder::sendData($updatedProduct, 204);

    }

}
