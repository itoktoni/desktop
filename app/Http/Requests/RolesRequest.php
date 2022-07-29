<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    use ValidationTrait;

    public function validation() : array
    {
        return [
            'roles_name' => 'required|min:3',
            'roles_active' => 'required',
        ];
    }
}
