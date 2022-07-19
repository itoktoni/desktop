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

    public static function field_category_id()
    {
        return 'product_category_id';
    }

    public function getFieldCategoryIdAttribute()
    {
        return $this->{self::field_category_id()};
    }

    public static function field_category_name()
    {
        return 'category_name';
    }

    public function getFieldCategoryNameAttribute()
    {
        return $this->{self::field_category_name()};
    }

    public static function field_brand_id()
    {
        return 'product_brand_id';
    }

    public function getFieldBrandIdAttribute()
    {
        return $this->{self::field_brand_id()};
    }

    public static function field_brand_name()
    {
        return 'brand_name';
    }

    public function getFieldBrandNameAttribute()
    {
        return $this->{self::field_brand_name()};
    }

    public static function field_unit_id()
    {
        return 'product_unit_id';
    }

    public function getFieldUnitIdAttribute()
    {
        return $this->{self::field_unit_id()};
    }

    public static function field_unit_name()
    {
        return 'unit_name';
    }

    public function getFieldUnitNameAttribute()
    {
        return $this->{self::field_unit_name()};
    }

}
