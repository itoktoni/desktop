<?php

namespace App\Dao\Entities;

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

    public static function field_role_id()
    {
        return 'role';
    }

    public function getFieldRoleIdAttribute()
    {
        return $this->{self::field_role_id()};
    }

    public static function field_role_name()
    {
        return 'role_name';
    }

    public function getFieldRoleNameAttribute()
    {
        return $this->{self::field_role_name()};
    }
}
