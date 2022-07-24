<?php

namespace App\Dao\Entities;

trait TicketTopicEntity
{
    public static function field_code()
    {
        return 'ticket_topic_id';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{self::field_code()};
    }

    public static function field_name()
    {
        return 'ticket_topic_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }

    public static function field_active()
    {
        return 'ticket_topic_active';
    }

    public function getFieldActiveAttribute()
    {
        return $this->{self::field_active()};
    }
}