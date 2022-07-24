<?php

namespace App\Dao\Entities;

use App\Dao\Models\Building;

trait LocationEntity
{
    public static function field_primary()
    {
        return 'location_id';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{$this->field_primary()};
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

    public function getFieldBuildingNameAttribute()
    {
        return $this->{Building::field_name()};
    }
}
