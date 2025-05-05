<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|string|max:255|not_in:admin,administrator,root,superuser,system,owner,support,contact,help,info,test,moderator,mod,null,undefined",
            "email" => "required|email|max:255|unique:users,email",
            /* confirmed expects "password_confirmation" in the request */
            "password" => "required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&\.]/|confirmed",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 400));
    }
}
