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

    public static function field_status()
    {
        return 'product_status';
    }

    public function getFieldStatusAttribute()
    {
        return $this->{self::field_status()};
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

    public static function field_sn()
    {
        return 'product_sn';
    }

    public function getFieldSnAttribute()
    {
        return $this->{self::field_sn()};
    }

    public static function field_price()
    {
        return 'product_price';
    }

    public function getFieldPriceAttribute()
    {
        return $this->{self::field_price()};
    }

    public static function field_buy_date()
    {
        return 'product_buy_date';
    }

    public function getFieldBuyDateAttribute()
    {
        return $this->{self::field_buy_date()};
    }

    public static function field_prod_year()
    {
        return 'product_prod_year';
    }

    public function getFieldProdYearAttribute()
    {
        return $this->{self::field_prod_year()};
    }

    public static function field_is_asset()
    {
        return 'product_is_asset';
    }

    public function getFieldIsAssetAttribute()
    {
        return $this->{self::field_is_asset()};
    }

    public static function field_location_id()
    {
        return 'product_location_id';
    }

    public function getFieldLocationIdAttribute()
    {
        return $this->{self::field_location_id()};
    }

    public static function field_location_name()
    {
        return 'location_name';
    }

    public function getFieldLocationNameAttribute()
    {
        return $this->{self::field_location_name()};
    }

    public static function field_department_id()
    {
        return 'product_department_id';
    }

    public function getFieldDepartmentIdAttribute()
    {
        return $this->{self::field_department_id()};
    }

    public static function field_department_name()
    {
        return 'department_name';
    }

    public function getFieldDepartmentNameAttribute()
    {
        return $this->{self::field_department_name()};
    }

}
