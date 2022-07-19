<?php

namespace App\Dao\Entities;

trait SparepartEntity
{
    public static function field_code()
    {
        return 'sparepart_id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    public static function field_name()
    {
        return 'sparepart_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_location_id()
    {
        return 'sparepart_location_id';
    }

    public function getFieldLocationIdAttribute()
    {
        return $this->{$this->field_location_id()};
    }

    public static function field_description()
    {
        return 'sparepart_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_stock()
    {
        return 'sparepart_stock';
    }

    public function getFieldStockAttribute()
    {
        return $this->{$this->field_stock()};
    }

    public static function field_product_id()
    {
        return 'sparepart_product_id';
    }

    public function getFieldproductIdAttribute()
    {
        return $this->{self::field_product_id()};
    }

    public static function field_product_name()
    {
        return 'product_name';
    }

    public function getFieldproductNameAttribute()
    {
        return $this->{self::field_product_name()};
    }
}
