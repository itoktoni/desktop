<?php

namespace Modules\System\Plugins;

use Illuminate\Support\Facades\DB;

class Xquery
{
    public static function autoNumber($tablename, $fieldid, $prefix, $codelength)
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
