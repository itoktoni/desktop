<?php

namespace App\Dao\Entities;

trait RoutesEntity
{
    public static function field_primary()
    {
        return 'route_code';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{self::field_primary()};
    }

    public static function field_name()
    {
        return 'route_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }

    public static function field_group()
    {
        return 'route_group';
    }

    public function getFieldGroupAttribute()
    {
        return $this->{self::field_group()};
    }

    public static function field_controller()
    {
        return 'route_controller';
    }

    public function getFieldControllerAttribute()
    {
        return $this->{self::field_controller()};
    }

    public static function field_active()
    {
        return 'route_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{self::field_active()};
    }

    public static function field_description()
    {
        return 'route_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{self::field_description()};
    }

    public static function field_sort()
    {
        return 'route_sort';
    }

    public function getFieldSortAttribute()
    {
        return $this->{self::field_sort()};
    }
}
