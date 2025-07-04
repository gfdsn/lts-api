<?php

namespace App\Http\Requests\Product\Accessory;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccessoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|string",
            "details" => "required|string",
            "price" => "required|integer",
            "stock" => "required|integer",
            "product_id" => "required|uuid|exists:products,id",
        ];
    }
}
