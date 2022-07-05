<?php

namespace App\Dao\Entities;

trait TagEntity
{
    public static function field_code()
    {
        return 'tag_code';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'tag_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
