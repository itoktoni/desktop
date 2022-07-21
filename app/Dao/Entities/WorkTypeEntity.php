<?php

namespace App\Dao\Entities;

trait WorkTypeEntity
{
    public static function field_code()
    {
        return 'work_type_id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'work_type_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
