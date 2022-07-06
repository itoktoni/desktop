<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    use ValidationTrait;

    public function validation()
    {
        return [
            'tag_name' => 'required|min:3',
        ];
    }
}
