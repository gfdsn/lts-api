<?php

namespace App\Http\Controllers;

use App\Domain\Product\Services\CategoryService;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{

    public function __construct(
        private CategoryService $categoryService
    ){
        $this->middleware('auth:api')->only(['index']);
    }

    public function index(): Collection
    {
        return $this->categoryService->getAll();
    }
}
