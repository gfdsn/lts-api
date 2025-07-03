<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => "required|uuid|exists:products,id",
        ];
    }
}
