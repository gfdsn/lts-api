<?php

namespace App\Http\Controllers;

use App\Application\Product\DTOs\Category\DeleteCategoryDTO;
use App\Application\Product\DTOs\Category\StoreCategoryDTO;
use App\Application\Product\DTOs\Category\UpdateCategoryDTO;
use App\Application\Product\UseCases\Category\DeleteCategoryUseCase;
use App\Application\Product\UseCases\Category\GetRandomCategoryCountUseCase;
use App\Application\Product\UseCases\Category\ListAllCategoriesUseCase;
use App\Application\Product\UseCases\Category\StoreCategoryUseCase;
use App\Application\Product\UseCases\Category\UpdateCategoryUseCase;
use App\Http\Middleware\VerifyIfUserIsAdmin;
use App\Http\Requests\Product\Category\DeleteCategoryRequest;
use App\Http\Requests\Product\Category\RandomCategoryCountRequest;
use App\Http\Requests\Product\Category\StoreCategoryRequest;
use App\Http\Requests\Product\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(VerifyIfUserIsAdmin::class)->except(['randomCategoryCount', 'filter']);
    }

    public function index(ListAllCategoriesUseCase $useCase): JsonResponse
    {
        $categories =  $useCase->execute();

        return ResponseBuilder::sendData(CategoryResource::collection($categories));
    }

    public function filter(ListAllCategoriesUseCase $useCase): JsonResponse
    {
        $categories =  $useCase->execute();

        return ResponseBuilder::sendData(
            collect(CategoryResource::collection($categories))->map(fn ($category) => collect($category)->only(['id', 'name']))
        );
    }

    public function store(StoreCategoryRequest $request, StoreCategoryUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new StoreCategoryDTO(...array_values($validated));

        try {
            $category = $useCase->execute($dto);

            return ResponseBuilder::sendData($category ,201);
        }catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function update(UpdateCategoryRequest $request, UpdateCategoryUseCase $useCase): JsonResponse
    {

        $validated = $request->validated();

        $dto = new UpdateCategoryDto(...array_values($validated));

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Category updated successfully.");
        } catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

    }

    public function delete(DeleteCategoryRequest $request, DeleteCategoryUseCase $useCase): JsonResponse
    {

        $validated = $request->validated();

        $dto = new DeleteCategoryDTO($validated['id']);

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Category deleted successfully.");
        } catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

    }

    public function randomCategoryCount(RandomCategoryCountRequest $request, GetRandomCategoryCountUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        try {
            $categories = $useCase->execute($validated["count"]);

            return ResponseBuilder::sendData(CategoryResource::collection($categories));
        }catch (\Throwable $e) {

            return ResponseBuilder::error($e->getMessage(), 500);
            //return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }


}
