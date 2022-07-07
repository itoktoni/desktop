<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    use ValidationTrait;

    public function validation()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'password' => Hash::make($this->password),
        ]);
    }
}
