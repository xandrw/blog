<?php

namespace App\Admin\Users\Http;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ];
    }
}
