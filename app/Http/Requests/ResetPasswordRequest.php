<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:users,email",
            "token" => "required|exists:password_reset_tokens,token",
            "password" => "required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&\.]/|confirmed", // "confirmed"
        ];
    }
}
