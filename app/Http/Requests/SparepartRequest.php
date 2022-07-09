<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class SparepartRequest extends FormRequest
{
    use ValidationTrait;

    public function validation()
    {
        return [
            'sparepart_name' => 'required|min:3',
            'sparepart_stock'=> 'required',
            'sparepart_location_id' => 'required',
            'sparepart_description'=> 'required',
        ];
    }
}