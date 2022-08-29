<?php

namespace App\Http\Requests;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    use ValidationTrait;

    public function validation() : array
    {
        return [
            'schedule_product_id' => 'required',
            'schedule_number' => 'required',
            'schedule_date' => 'required',
        ];
    }
}
