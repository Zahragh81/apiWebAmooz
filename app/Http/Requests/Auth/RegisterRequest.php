<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
