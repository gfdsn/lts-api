<?php

namespace App\Http\Requests\User\Wishlist;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserWishlistRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "user_id" => "required|uuid|exists:users,id",
            "product_id" => "required|uuid|exists:products,id",
        ];
    }
}
