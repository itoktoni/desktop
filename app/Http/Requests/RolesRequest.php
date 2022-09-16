<?php

namespace App\Http\Requests;

use App\Dao\Models\Roles;
use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    use ValidationTrait;

    public function prepareForValidation()
    {
        $this->merge([
            Roles::field_primary() => strtolower($this->role_name)
        ]);
    }

    public function validation() : array
    {
        return [
            'role_name' => 'required|min:3',
            'role_active' => 'required',
        ];
    }
}
