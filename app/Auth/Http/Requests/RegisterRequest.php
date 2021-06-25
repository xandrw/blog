<?php

namespace App\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha', 'min:5', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', 'min:8']
        ];
    }
}
