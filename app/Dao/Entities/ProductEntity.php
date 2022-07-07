<?php

namespace App\Dao\Entities;

trait ProductEntity
{
    public static function field_code()
    {
        return 'product_id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{self::field_code()};
    }

    public static function field_name()
    {
        return 'product_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }

    public static function field_description()
    {
        return 'product_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{self::field_description()};
    }

    public static function field_active()
    {
        return 'product_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{self::field_active()};
    }
}
