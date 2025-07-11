<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
