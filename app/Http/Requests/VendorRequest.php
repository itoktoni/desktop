<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class VendorRequest extends FormRequest
{
    use ValidationTrait;

    public function validation() : array
    {
        return [
            'vendor_id' => 'required',
            'vendor_name' => 'required',
            'vendor_email' => 'required|email',
        ];
    }
}