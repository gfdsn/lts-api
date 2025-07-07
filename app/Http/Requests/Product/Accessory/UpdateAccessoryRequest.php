<?php

namespace App\Http\Requests\Product\Accessory;

use App\Http\Requests\BaseRequest;

class UpdateAccessoryRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => "required|uuid|exists:accessories,id",
            "name" => "required|string",
            "details" => "required|string",
            "price" => "required|int",
            "stock" => "required|int",
            "product_id" => "required|uuid|exists:products,id",
        ];
    }
}
