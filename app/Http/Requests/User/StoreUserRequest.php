<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class StoreUserRequest extends BaseRequest
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
            "password" => "required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&\.]/",
            "password_confirmation" => "required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&\.]/",
        ];
    }
}
