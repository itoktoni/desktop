<?php

namespace App\Http\Requests;

use App\Dao\Models\Menus;
use App\Dao\Models\Routes;
use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RoutesRequest extends FormRequest
{
    use ValidationTrait;

    public function prepareForValidation()
    {
        $this->offsetUnset('_token');

        $map = collect($this->detail)->map(function ($item){
            $data[Menus::field_pimary()] = $item['temp_id'];
            $data[Menus::field_module()] = $item['temp_module'];
            $data[Menus::field_name()] = $item['temp_name'];
            $data[Menus::field_reset()] = $item['temp_reset'];
            $data[Menus::field_show()] = $item['temp_show'];
            $data[Menus::field_active()] = $item['temp_active'];
            return $data;
        });

        $this->merge([
            Routes::field_active() => $this->{Routes::field_active()} == "1" ? 1 : 0,
            Routes::field_controller() => addcslashes($this->{Routes::field_controller()},''),
            'items' => $map->toArray()
        ]);
    }

    public function validation() : array
    {
        return [
            'route_name' => 'required|min:1',
            'route_group' => 'required',
            'route_controller' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $check = Routes::where(Routes::field_pimary(), $this->route_slug)->get()->count();
            if($check){
                $validator->errors()->add(Routes::field_pimary(), 'Code must unique!');
            }

            $path = str_replace('app', '', app_path());
            if(!file_exists($path . $this->route_controller . '.php')){
                $validator->errors()->add(Routes::field_controller(), 'Controller Must Exist!');
            }


        });
    }

}
