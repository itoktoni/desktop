<?php

namespace App\Dao\Entities;

trait LocationEntity
{
    public static function field_code()
    {
        return 'location_id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'location_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_description()
    {
        return 'location_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_building_id()
    {
        return 'location_building_id';
    }

    public function getFieldBuildingIdAttribute()
    {
        return $this->{self::field_building_id()};
    }

    public static function field_building_name()
    {
        return 'building_name';
    }

    public function getFieldBuildingNameAttribute()
    {
        return $this->{self::field_building_name()};
    }
}
