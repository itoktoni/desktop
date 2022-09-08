<?php

namespace Plugins;

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
}
