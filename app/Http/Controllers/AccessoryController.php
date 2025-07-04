<?php

namespace App\Http\Controllers;

use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Application\Product\UseCases\Accessory\ListAllAccessoriesUseCase;
use App\Application\Product\UseCases\Accessory\StoreAccessoryUseCase;
use App\Http\Middleware\VerifyIfUserIsAdmin;
use App\Http\Requests\Product\Accessory\StoreAccessoryRequest;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class AccessoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(VerifyIfUserIsAdmin::class);
    }

    public function index(ListAllAccessoriesUseCase $useCase): JsonResponse
    {
        return ResponseBuilder::sendData($useCase->execute());
    }

    public function store(StoreAccessoryRequest $request, StoreAccessoryUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new StoreAccessoryDTO(...array_values($validated));

        try {
            $accessory = $useCase->execute($dto);

            return ResponseBuilder::sendData($accessory, 201);
        }  catch (\Throwable $e) {
            return ResponseBuilder::error($e->getMessage(), 500);
            //return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

    }
}
