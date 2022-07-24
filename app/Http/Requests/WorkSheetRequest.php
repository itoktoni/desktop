<?php

namespace App\Http\Requests;
use App\Dao\Models\WorkSheet;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class WorkSheetRequest extends FormRequest
{
    use ValidationTrait;

    public function prepareForValidation()
    {
      $uuid = Uuid::uuid1();
        $this->merge([
            WorkSheet::field_primary() => $uuid->toString(),
        ]);
    }

    public function validation()
    {
        return [
            'work_sheet_code' => 'required|unique:work_sheet',
            'work_sheet_name' => 'required',
            'work_sheet_description' => 'required',
            'work_sheet_check' => 'required',
            'work_sheet_result' => 'required',
            'work_sheet_type_id' => 'required',
            'work_sheet_product_id' => 'required',
        ];
    }
}
