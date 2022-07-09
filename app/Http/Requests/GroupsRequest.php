<?php

namespace App\Http\Requests;

use App\Dao\Models\Groups;
use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class GroupsRequest extends FormRequest
{
    use ValidationTrait;

    public function validation()
    {
        return [
            'group_name' => 'required|min:3|unique:groups',
            'group_active' => 'required',
        ];
    }
}
