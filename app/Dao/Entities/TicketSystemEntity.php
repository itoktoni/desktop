<?php

namespace App\Dao\Entities;

use App\Dao\Enums\TicketPriority;
use App\Dao\Models\TicketTopic;
use App\Dao\Models\Department;
use App\Dao\Models\Location;

trait TicketSystemEntity
{
    public static function field_primary()
    {
        return 'ticket_system_code';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{$this->field_primary()};
    }

    public static function field_name()
    {
        return 'ticket_system_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_status()
    {
        return 'ticket_system_status';
    }

    public function getFieldStatusAttribute()
    {
        return $this->{$this->field_status()};
    }

    public static function field_description()
    {
        return 'ticket_system_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_priority()
    {
        return 'ticket_system_priority';
    }

    public function getFieldPriorityAttribute()
    {
        return TicketPriority::getDescription($this->{$this->field_priority()});
    }

    public static function field_reported_at()
    {
        return 'ticket_system_reported_at';
    }

    public function getFieldReportedAtAttribute()
    {
        return $this->{$this->field_reported_at()};
    }

    public static function field_reported_by()
    {
        return 'ticket_system_reported_by';
    }

    public function getFieldReportedByAttribute()
    {
        return $this->{$this->field_reported_by()};
    }

    public static function field_finished_at()
    {
        return 'ticket_system_finished_at';
    }

    public function getFieldFinishedAtAttribute()
    {
        return $this->{$this->field_finished_at()};
    }

    public static function field_finished_by()
    {
        return 'ticket_system_finished_by';
    }

    public function getFieldFinishedByAttribute()
    {
        return $this->{$this->field_finished_by()};
    }

    public static function field_topic_id()
    {
        return 'ticket_system_topic_id';
    }

    public function getFieldTopicNameAttribute()
    {
        return $this->{TicketTopic::field_name()};
    }

    public static function field_department_id()
    {
        return 'ticket_system_department_id';
    }

    public function getFieldDepartmentNameAttribute()
    {
        return $this->{Department::field_name()};
    }

    public static function field_location_id()
    {
        return 'ticket_system_location_id';
    }

    public function getFieldLocationNameAttribute()
    {
        return $this->{Location::field_name()};
    }

    public static function field_implementor()
    {
        return 'ticket_system_implementor';
    }

    public function getFieldImplementorAttribute()
    {
        return json_decode($this->{self::field_implementor()});
    }
}
