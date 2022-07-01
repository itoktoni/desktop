<?php

namespace App\Dao\Entities;

trait UserEntity
{
    public function field_code()
    {
        return 'id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public function field_name()
    {
        return 'name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public function field_email()
    {
        return 'email';
    }

    public function getFieldEmailAttribute()
    {
        return $this->{$this->field_email()};
    }

    public function field_active()
    {
        return 'active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{$this->field_active()};
    }
}
