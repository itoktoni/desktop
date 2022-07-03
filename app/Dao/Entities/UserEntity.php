<?php

namespace App\Dao\Entities;

trait UserEntity
{
    public static function field_code()
    {
        return 'id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{self::field_code()};
    }

    public static function field_name()
    {
        return 'name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }

    public static function field_email()
    {
        return 'email';
    }

    public function getFieldEmailAttribute()
    {
        return $this->{self::field_email()};
    }

    public static function field_active()
    {
        return 'active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{self::field_active()};
    }
}
