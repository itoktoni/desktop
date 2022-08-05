<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\TicketSystemEntity;
use App\Dao\Enums\TicketStatus;
use App\Dao\Enums\TicketPriority;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\ExcelTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Ramsey\Uuid\Uuid;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;
use Wildside\Userstamps\Userstamps;

class TicketSystem extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, TicketSystemEntity, Userstamps, ActiveTrait, PowerJoins, OptionTrait, SoftDeletes, ExcelTrait;

    protected $table = 'ticket_system';
    protected $primaryKey = 'ticket_system_code';

    protected $fillable = [
        'ticket_system_code',
        'ticket_system_topic_id',
        'ticket_system_name',
        'ticket_system_description',
        'ticket_system_priority',
        'ticket_system_result',
        'ticket_system_department_id',
        'ticket_system_reported_at',
        'ticket_system_reported_by',
        'ticket_system_created_at',
        'ticket_system_created_by',
        'ticket_system_updated_at',
        'ticket_system_updated_by',
        'ticket_system_deleted_at',
        'ticket_system_deleted_by',
        'ticket_system_finished_at',
        'ticket_system_finished_by',
        'ticket_system_status',
    ];

    public $sortable = [
        'ticket_system_code',
        'ticket_system_name',
        'ticket_system_priority',
        'ticket_system_topic_id',
        'ticket_system_department_id',
    ];

    protected $filters = [
        'filter',
        'ticket_system_department_id',
    ];

    public $timestamps = true;
    public $incrementing = false;

    const CREATED_AT = 'ticket_system_created_at';
    const UPDATED_AT = 'ticket_system_updated_at';
    const DELETED_AT = 'ticket_system_deleted_at';

    const CREATED_BY = 'ticket_system_created_by';
    const UPDATED_BY = 'ticket_system_updated_by';
    const DELETED_BY = 'ticket_system_deleted_by';

    public function fieldSearching()
    {
        return $this->field_primary();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name('Code')->sort()->excel(),
            DataBuilder::build(TicketTopic::field_name())->name('Topic')->sort()->excel(),
            DataBuilder::build($this->field_name())->name('Subject')->sort()->excel(),
            DataBuilder::build(Department::field_name())->name('Department Name')->sort()->excel(),
            DataBuilder::build($this->field_description())->name('Description')->show(false)->excel(),
            DataBuilder::build($this->field_priority())->name('Priority')->excel(),
        ];
    }

    public function has_ticket_topic()
    {
        return $this->hasOne(TicketTopic::class, TicketTopic::field_primary(), self::field_topic_id());
    }

    public function has_department()
    {
        return $this->hasOne(Department::class, Department::field_primary(), self::field_department_id());
    }

    public function has_reported()
    {
        return $this->hasOne(User::class, User::field_primary(), self::field_reported_by());
    }

    public function ticketTopicNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(TicketTopic::field_name(), $direction);
        return $query;
    }

    public function departmentNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(Department::field_name(), $direction);
        return $query;
    }

    /*
    using model event
    https://coderflex.com/blog/how-to-use-model-observers-in-laravel
     */

    public static function boot()
    {
        parent::creating(function ($model) {
            if (empty($model->{self::field_status()}) || empty($model->{self::field_priority()})) {
                $model->{self::field_status()} = TicketStatus::Open;
                $model->{self::field_priority()} = TicketPriority::Low;
                $model->{self::field_reported_by()} = auth()->user()->id;
                $model->{self::field_reported_at()} = date('Y-m-d h:i:s');
            }

            $model->{self::field_primary()} = Uuid::uuid1()->toString();

        });

        parent::saving(function ($model) {
            if ($model->{self::field_status()} == TicketStatus::Close) {
                $model->{self::field_finished_by()} = auth()->user()->id;
                $model->{self::field_finished_at()} = date('Y-m-d h:i:s');
            }
        });

        parent::boot();
    }

}
