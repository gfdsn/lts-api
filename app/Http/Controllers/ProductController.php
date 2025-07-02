<?php

namespace App\Http\Controllers;

use App\Application\Product\DTOs\StoreProductDTO;
use App\Application\Product\UseCases\StoreProductUseCase;
use App\Http\Requests\Product\StoreProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function store(StoreProductRequest $request, StoreProductUseCase $useCase): JsonResponse
    {
        $dto = new StoreProductDTO();

        $product = $useCase->execute($dto);

        return response()->json($product, 201);
    }


}
