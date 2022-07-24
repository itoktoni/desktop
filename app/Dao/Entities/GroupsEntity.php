<?php

namespace App\Dao\Entities;

trait GroupsEntity
{
    public static function field_primary()
    {
        return 'group_code';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{$this->field_primary()};
    }

    public static function field_name()
    {
        return 'group_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_description()
    {
        return 'group_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_active()
    {
        return 'group_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{$this->field_active()};
    }

    public static function field_sort()
    {
        return 'group_sort';
    }

    public function getFieldSortAttribute()
    {
        return $this->{self::field_sort()};
    }

    public static function field_icon()
    {
        return 'group_icon';
    }

    public function getFieldIconAttribute()
    {
        return $this->{self::field_icon()};
    }

    public static function field_url()
    {
        return 'group_url';
    }

    public function getFieldUrlAttribute()
    {
        return $this->{self::field_url()};
    }
}
