<?php

namespace App\Http\Requests;

use App\Dao\Models\Routes;
use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RoutesRequest extends FormRequest
{
    use ValidationTrait;

    public function prepareForValidation()
    {
        $this->offsetUnset('_token');
        $this->merge([
            Routes::field_active() => $this->{Routes::field_active()} == "1" ? 1 : 0,
            Routes::field_controller() => addcslashes($this->{Routes::field_controller()},''),
        ]);
    }

    public function validation()
    {
        return [
            'route_name' => 'required|min:1',
            'route_controller' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $check = Routes::where(Routes::field_code(), $this->route_slug)->get()->count();
            if($check){
                $validator->errors()->add(Routes::field_code(), 'Code must unique!');
            }

            $path = str_replace('app', '', app_path());
            if(!file_exists($path . $this->route_controller . '.php')){
                $validator->errors()->add(Routes::field_controller(), 'Controller Must Exist!');
            }


        });
    }

}
