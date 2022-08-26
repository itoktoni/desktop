<?php

namespace App\Dao\Entities;

use App\Dao\Models\Product;

trait ScheduleEntity
{
    public static function field_primary()
    {
        return 'schedule_id';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{self::field_primary()};
    }

    public static function field_name()
    {
        return 'schedule_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }

    public static function field_description()
    {
        return 'schedule_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{self::field_description()};
    }

    public static function field_product_id()
    {
        return 'schedule_product_id';
    }

    public function getFieldProductNameAttribute()
    {
        return $this->{Product::field_name()};
    }

    public static function field_number()
    {
        return 'schedule_number';
    }

    public function getFieldNumberAttribute()
    {
        return $this->{self::field_number()};
    }

    public static function field_every()
    {
        return 'schedule_every';
    }

    public function getFieldEveryAttribute()
    {
        return $this->{self::field_every()};
    }

    public static function field_date()
    {
        return 'schedule_date';
    }

    public function getFieldDateAttribute()
    {
        return $this->{self::field_date()};
    }

    public static function field_notification()
    {
        return 'schedule_notification';
    }

    public function getFieldNotificationAttribute()
    {
        return $this->{self::field_notification()};
    }
}
