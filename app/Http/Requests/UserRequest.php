<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

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
}
