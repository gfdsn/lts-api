<?php

namespace App\Http\Controllers;

use App\Application\Product\DTOs\Accessory\DeleteAccessoryDTO;
use App\Application\Product\DTOs\Accessory\StoreAccessoryDTO;
use App\Application\Product\DTOs\Accessory\UpdateAccessoryDTO;
use App\Application\Product\UseCases\Accessory\DeleteAccessoryUseCase;
use App\Application\Product\UseCases\Accessory\ListAllAccessoriesUseCase;
use App\Application\Product\UseCases\Accessory\StoreAccessoryUseCase;
use App\Application\Product\UseCases\Accessory\UpdateAccessoryUseCase;
use App\Http\Middleware\VerifyIfUserIsAdmin;
use App\Http\Requests\Product\Accessory\DeleteAccessoryRequest;
use App\Http\Requests\Product\Accessory\StoreAccessoryRequest;
use App\Http\Requests\Product\Accessory\UpdateAccessoryRequest;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

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

            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

    }

    public function update(UpdateAccessoryRequest $request, UpdateAccessoryUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();
        $dto = new UpdateAccessoryDTO(...array_values($validated));

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Accessory was successfully updated.");
        } catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function delete(DeleteAccessoryRequest $request, DeleteAccessoryUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new DeleteAccessoryDTO($validated["id"]);

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Accessory was successfully deleted.");
        } catch (\Throwable $e) {
            // ResponseBuilder::error("There was a server error, please try again later.", 500);
            return ResponseBuilder::error($e->getMessage(), 500);
        }
    }

}
