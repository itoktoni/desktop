<?php

namespace App\Http\Requests;
use App\Dao\Models\TicketSystem;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class TicketSystemRequest extends FormRequest
{
    use ValidationTrait;

    public function prepareForValidation()
    {
        dd(request()->all());
        $this->merge([
            // 'content' => ''
        ]);
    }

    public function validation() : array
    {
        return [
            'ticket_system_description' => 'required',
            'ticket_system_topic_id' => 'required',
            'ticket_system_department_id' => 'required',
        ];
    }
}
