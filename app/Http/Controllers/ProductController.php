<?php

namespace App\Http\Controllers;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Application\Product\UseCases\ListAllProductsUseCase;
use App\Application\Product\UseCases\StoreProductUseCase;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(ListAllProductsUseCase $useCase): JsonResponse
    {
        $products = $useCase->execute();

        return ResponseBuilder::sendData($products);
    }

    public function store(StoreProductRequest $request, StoreProductUseCase $useCase): JsonResponse
    {
        $dto = new StoreProductDTO();

        $product = $useCase->execute($dto);

        return response()->json($product, 201);
    }
}
