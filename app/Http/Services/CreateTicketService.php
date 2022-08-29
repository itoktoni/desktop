<?php

namespace App\Http\Services;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\TicketSystem;
use App\Events\CreateTicketEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Plugins\Alert;

class CreateTicketService extends CreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {

            if ($data->has('file_picture')) {
                $file_logo = $data->file('file_picture');
                $extension = $file_logo->getClientOriginalExtension();
                $name = uniqid() .'.'. $extension;
                $file_logo->storeAs('public/ticket/', $name);
                $data[TicketSystem::field_picture()] = $name;
            }

            $check = $repository->saveRepository($data->all());
            if(isset($check['status']) && $check['status']){

                Alert::create();
                event(new CreateTicketEvent($check['data']));
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }
}
