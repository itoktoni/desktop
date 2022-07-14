<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    use ValidationTrait;

    public function validation()
    {
        return [
            'unit_name',
        ];
    }
}