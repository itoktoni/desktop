<?php

namespace App\Dao\Traits;

use Plugins\Filter;
use Spatie\SimpleExcel\SimpleExcelWriter;

trait ExcelTrait
{
    public static $export_data;
    public static $export_model;
    public static $export_query;
    public static $export_label;
    public static $export_name;
    public static $export_id;

    public static function export($data, $name)
    {
        return SimpleExcelWriter::streamDownload($name)
            ->noHeaderRow()
            ->addRows($data->toArray());
    }
}
