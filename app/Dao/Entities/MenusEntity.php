<?php

namespace App\Dao\Entities;

trait MenusEntity
{
    public static function field_code()
    {
        return 'menu_code';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'menu_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_description()
    {
        return 'menu_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_active()
    {
        return 'menu_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{$this->field_active()};
    }

    public static function field_reset()
    {
        return 'menu_reset';
    }

    public function getFieldResetAttribute()
    {
        return $this->{$this->field_reset()};
    }

    public static function field_show()
    {
        return 'menu_show';
    }

    public function getFieldShowAttribute()
    {
        return $this->{$this->field_show()};
    }

    public static function field_module()
    {
        return 'menu_module';
    }

    public function getFieldModuleAttribute()
    {
        return $this->{$this->field_module()};
    }
}
