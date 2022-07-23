<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class WorkSheetRequest extends FormRequest
{
    use ValidationTrait;

    public function validation()
    {
        return [
            'work_sheet_name' => 'required',
            'work_sheet_description' => 'required',
            'work_sheet_check' => 'required',
            'work_sheet_result' => 'required',
            'work_sheet_type_id' => 'required',
            'work_sheet_product_id' => 'required',
        ];
    }
}
