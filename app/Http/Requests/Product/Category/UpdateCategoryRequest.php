<?php

namespace App\Http\Requests\Product\Category;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => "required|uuid|exists:categories,id",
            "name" => "required|string",
            "icon" => "required|string",
        ];
    }
}
