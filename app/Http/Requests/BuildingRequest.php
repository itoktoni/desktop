<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class BuildingRequest extends FormRequest
{
    use ValidationTrait;

    public function validation()
    {
        return [
            'building_name' => 'required|min:3',
            'building_address' => 'required|min:3',
            'building_description'=> 'required|max:255',
            'building_contact_person'=> 'required|min:3',
            'building_contact_phone'=> 'required|regex:/[0-9]{12}/',
        ];
    }
}
