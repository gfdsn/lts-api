<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "product_id" => "required|uuid|exists:products,id",
            "quantity" => "required|integer"
        ];
    }
}
