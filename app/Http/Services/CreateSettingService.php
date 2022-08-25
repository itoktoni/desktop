<?php

namespace App\Http\Services;

use App\Dao\Facades\EnvFacades;
use Plugins\Alert;

class CreateSettingService
{
    public function save($data)
    {
        $check = false;
        try {

            EnvFacades::setValue('APP_NAME', $data->name);

            if ($data->has('file_logo')) {
                $file_logo = $data->file('file_logo');
                $extension = $file_logo->getClientOriginalExtension();
                $name = 'logo.' . $extension;
                $file_logo->storeAs('/public/', $name);
                EnvFacades::setValue('APP_LOGO', $name);
            }

            if ($data->has('file_header')) {
                $file_header = $data->file('file_header');
                $extension = $file_header->getClientOriginalExtension();
                $name = 'header.' . $extension;
                $file_header->storeAs('/public/', $name);
                EnvFacades::setValue('APP_HEADER', $name);
            }

            Alert::create();

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }
}
