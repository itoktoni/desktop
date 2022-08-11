<?php

namespace App\Dao\Entities;

use App\Dao\Models\Roles;

trait UserEntity
{
    public static function field_primary()
    {
        return 'id';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{self::field_primary()};
    }

    public static function field_name()
    {
        return 'name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }

    public static function field_email()
    {
        return 'email';
    }

    public function getFieldEmailAttribute()
    {
        return $this->{self::field_email()};
    }

    public static function field_active()
    {
        return 'active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{self::field_active()};
    }

    public static function field_role()
    {
        return 'role';
    }

    public function getFieldRoleNameAttribute()
    {
        return $this->{Roles::field_name()};
    }
}
