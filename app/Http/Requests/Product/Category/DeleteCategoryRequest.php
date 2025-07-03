<?php

namespace App\Http\Requests\Product\Category;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => "required|uuid|exists:categories,id",
        ];
    }
}
