<?php

namespace App\Admin\Users\Http;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends CreateUserRequest
{
    public function rules(): array
    {
        $parentRules = parent::rules();
        $parentRules['password'] = ['present', 'nullable', 'min:8'];

        return $parentRules;
    }
}
