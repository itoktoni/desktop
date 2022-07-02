<?php

namespace App\Dao\Entities;

trait BuildingEntity
{
    public function field_code()
    {
        return 'building_id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public function field_name()
    {
        return 'building_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public function field_description()
    {
        return 'building_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public function field_contact_person()
    {
        return 'building_contact_person';
    }

    public function getFieldContactPersonAttribute()
    {
        return $this->{$this->field_contact_person()};
    }

    public function field_contact_phone()
    {
        return 'building_contact_phone';
    }

    public function getFieldContactPhoneAttribute()
    {
        return $this->{$this->field_contact_phone()};
    }

    public function field_address()
    {
        return 'building_address';
    }

    public function getFieldAddressAttribute()
    {
        return $this->{$this->field_address()};
    }

    public function field_active()
    {
        return 'building_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{$this->field_active()};
    }
}
