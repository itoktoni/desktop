<?php

namespace App\Dao\Entities;

trait UnitEntity
{
    public static function field_code()
    {
        return 'unit_code';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'unit_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
