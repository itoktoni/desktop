<?php

namespace App\Http\Requests;

use App\Dao\Models\Tag;
use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TagRequest extends FormRequest
{
    use ValidationTrait;

    public function prepareForValidation()
    {
        $this->merge([
            Tag::field_code() => Str::snake($this->{Tag::field_name()})
        ]);
    }

    public function validation()
    {
        return [
            'tag_name' => 'required|min:3',
        ];
    }
}
