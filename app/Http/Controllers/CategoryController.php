<?php

namespace App\Http\Controllers;

use App\Application\Product\UseCases\Category\ListAllCategoriesUseCase;
use App\Http\Middleware\VerifyIfUserIsAdmin;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(VerifyIfUserIsAdmin::class);
    }

    public function index(ListAllCategoriesUseCase $useCase): JsonResponse
    {
        $categories =  $useCase->execute();

        return ResponseBuilder::sendData($categories);
    }
}
