<?php

namespace App\Dao\Entities;

trait RolesEntity
{
    public static function field_code()
    {
        return 'role_code';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'role_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_description()
    {
        return 'role_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_active()
    {
        return 'role_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{$this->field_active()};
    }
}
