<?php

namespace App\Http\Services;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\Routes;
use Illuminate\Support\Facades\Cache;
use Plugins\Alert;
use Plugins\Notes;

class UpdateRoutesService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        Cache::forget('routes');
        if ($check['status']) {
            if(request()->wantsJson()){
                return response()->json($check)->getData();
            }
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }

    public function sort($data)
    {
        foreach($data->get('sort') as $sort){
            $update = Routes::find($sort['key'])->update([Routes::field_sort() => $sort['value']]);
        }

        $check = Notes::update($update);
        if ($check['status']) {
            if(request()->wantsJson()){
                return response()->json($check)->getData();
            }
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
