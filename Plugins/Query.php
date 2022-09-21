<?php

namespace Plugins;

use App\Dao\Enums\TicketStatus;
use App\Dao\Models\Location;
use App\Dao\Models\Product;
use App\Dao\Models\Roles;
use App\Dao\Models\TicketSystem;
use Illuminate\Support\Facades\DB;

class Query
{
    public static function upsert($model, $where, $data)
    {
        $batch = $model->where($where)->first();
        if ($batch) {
            $batch->update($data);
        } else {
            $model->create($data);
        }
    }

    public static function autoNumber($tablename, $fieldid, $prefix = 'AUTO', $codelength = 10)
    {
        $db = DB::table($tablename);
        $db->select(DB::raw('max(' . $fieldid . ') as maxcode'));
        $db->where($fieldid, "like", "$prefix%");

        $ambil = $db->first();
        $data = $ambil->maxcode;

        if ($db->count() > 0) {
            $code = substr($data, strlen($prefix));
            $countcode = ($code) + 1;
        } else {
            $countcode = 1;
        }
        $newcode = $prefix . str_pad($countcode, $codelength - strlen($prefix), "0", STR_PAD_LEFT);
        return $newcode;
    }

    public static function getProduct()
    {
        $product = Product::with(['has_location'])->get()
            ->mapWithKeys(function ($item) {
                $location_name = $item->has_location->field_name ?? '';
                $product_name = $item->field_name ?? '';
                $name = $location_name . ' - ' . $product_name;
                $id = $item->field_primary ?? '' . '';
                return [$id => $name];
            });

        return $product;
    }

    public static function getLocation(){
        $location = Location::with(['has_building'])->get()
            ->mapWithKeys(function ($item) {
                $name = $item->has_building->field_name . ' - ' . $item->field_name;
                $id = $item->field_primary . '';
                return [$id => $name];
            });

        return $location;
    }

    public static function getRole($role){
        return Roles::find($role)->role_type ?? null;
    }

    public static function getTotalTicket($status = TicketStatus::Open){
        return TicketSystem::select(TicketSystem::field_primary())->where(TicketSystem::field_status(), $status)->count();
    }
}
