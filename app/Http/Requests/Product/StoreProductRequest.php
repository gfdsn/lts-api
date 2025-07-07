<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class StoreProductRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => "required|string",
            "description" => "required|string",
            "attributes.weight" => "required|integer",
            "attributes.color" => "required|string",
            "measures.length" => "required|integer",
            "measures.width" => "required|integer",
            "measures.height" => "required|integer",
            "classification.category_id" => "required|uuid|exists:categories,id",
            "classification.subcategory_id" => "required|uuid|exists:categories,id",
            "price" => "required|integer",
            "images" => "required|array",
            "documentation" => "required|array",
            "stock" => "required|integer",
            "accessories" => "required|array",
            'accessories.*' => 'uuid|exists:accessories,id',
        ];
    }
}
