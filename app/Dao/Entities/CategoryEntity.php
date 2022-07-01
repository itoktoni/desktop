<?php

namespace App\Dao\Entities;

trait CategoryEntity
{
    public function field_code()
    {
        return 'category_id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public function field_name()
    {
        return 'category_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public function field_description()
    {
        return 'category_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public function field_active()
    {
        return 'category_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{$this->field_active()};
    }
}
