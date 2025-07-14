<?php

namespace App\Http\Requests\Product\Category;

use App\Http\Requests\BaseRequest;

class RandomCategoryCountRequest extends BaseRequest
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
