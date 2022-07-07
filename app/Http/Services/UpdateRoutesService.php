<?php

namespace App\Http\Services;

use App\Dao\Interfaces\CrudInterface;
use Illuminate\Support\Facades\Cache;
use Plugins\Alert;

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
}
