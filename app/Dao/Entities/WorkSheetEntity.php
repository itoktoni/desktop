<?php

namespace App\Dao\Entities;

use App\Dao\Models\Location;
use App\Dao\Models\Product;
use App\Dao\Models\WorkType;

trait WorkSheetEntity
{
    public static function field_code()
    {
        return 'work_sheet_code';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'work_sheet_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_description()
    {
        return 'work_sheet_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_check()
    {
        return 'work_sheet_check';
    }

    public function getFieldCheckAttribute()
    {
        return $this->{$this->field_check()};
    }

    public static function field_result()
    {
        return 'work_sheet_result';
    }

    public function getFieldResultAttribute()
    {
        return $this->{$this->field_result()};
    }

    public static function field_reported_at()
    {
        return 'work_sheet_reported_at';
    }

    public function getFieldReportedAtAttribute()
    {
        return $this->{$this->field_reported_at()};
    }

    public static function field_reported_by()
    {
        return 'work_sheet_reported_by';
    }

    public function getFieldReportedByAttribute()
    {
        return $this->{$this->field_reported_by()};
    }

    public static function field_finished_at()
    {
        return 'work_sheet_finished_at';
    }

    public function getFieldFinishedAtAttribute()
    {
        return $this->{$this->field_finished_at()};
    }

    public static function field_finished_by()
    {
        return 'work_sheet_finished_by';
    }

    public function getFieldFinishedByAttribute()
    {
        return $this->{$this->field_finished_by()};
    }

    public static function field_ticket_code()
    {
        return 'work_sheet_ticket_code';
    }

    public function getFieldTicketCodeAttribute()
    {
        return $this->{$this->field_ticket_code()};
    }

    public static function field_type_id()
    {
        return 'work_sheet_type_id';
    }

    public function getFieldTypeNameAttribute()
    {
        return $this->{WorkType::field_name()};
    }

    public static function field_product_id()
    {
        return 'work_sheet_product_id';
    }

    public function getFieldProductNameAttribute()
    {
        return $this->{Product::field_name()};
    }
}