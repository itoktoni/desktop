<?php

namespace App\Dao\Entities;

use App\Dao\Models\Brand;
use App\Dao\Models\Category;
use App\Dao\Models\Department;
use App\Dao\Models\Location;
use App\Dao\Models\Unit;

trait ProductEntity
{
    public static function field_primary()
    {
        return 'product_id';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{self::field_primary()};
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

    public function getFieldLocationNameAttribute()
    {
        return $this->{Location::field_name()};
    }

    public static function field_department_id()
    {
        return 'product_department_id';
    }

    public function getFieldDepartmentNameAttribute()
    {
        return $this->{Department::field_name()};
    }

    public static function field_brand_id()
    {
        return 'product_brand_id';
    }

    public function getFieldBrandNameAttribute()
    {
        return $this->{Brand::field_name()};
    }

    public static function field_unit_code()
    {
        return 'product_unit_code';
    }

    public function getFieldUnitNameAttribute()
    {
        return $this->{Unit::field_name()};
    }

    public static function field_category_id()
    {
        return 'product_category_id';
    }

    public function getFieldCategoryNameAttribute()
    {
        return $this->{Category::field_name()};
    }

}
