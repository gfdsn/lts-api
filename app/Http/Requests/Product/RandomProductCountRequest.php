<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class RandomProductCountRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "count" => "required|integer"
        ];
    }
}
