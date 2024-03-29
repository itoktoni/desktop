<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\TicketSystemEntity;
use App\Dao\Enums\TicketPriority;
use App\Dao\Enums\TicketStatus;
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
        'ticket_system_implementor',
        'ticket_system_description',
        'ticket_system_priority',
        'ticket_system_result',
        'ticket_system_picture',
        'ticket_system_department_id',
        'ticket_system_location_id',
        'ticket_system_product_id',
        'ticket_system_work_type_id',
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
        'ticket_system_schedule_id',
    ];

    public $sortable = [
        'ticket_system_code',
        'ticket_system_priority',
        'ticket_system_topic_id',
        'ticket_system_department_id',
    ];

    protected $filters = [
        'filter',
        'ticket_system_department_id',
        'ticket_system_ticket_id',
        'date',
        'start_date',
        'end_date',
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

    public function date($query){
        $date = request()->get('date');
        if($date){
            $query = $query->where($this->field_reported_at(), $date);
        }

        return $query;
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name(__('Code'))->sort()->excel(),
            DataBuilder::build($this->field_reported_at())->name(__('Reported At'))->sort()->excel(),
            DataBuilder::build($this->field_reported_name())->name(__('Reported By'))->sort()->excel(),
            DataBuilder::build(TicketTopic::field_name())->name(__('Topic'))->sort()->show(env('TICKET_TOPIC', true))->excel(),
            DataBuilder::build($this->field_name())->name(__('Subject'))->sort()->show(env('TICKET_NAME', true))->excel(),
            DataBuilder::build(Department::field_name())->name(__('Department Name'))->sort()->show(env('TICKET_DEPARTMENT', true))->excel(),
            DataBuilder::build(Location::field_name())->name(__('Location Name'))->sort()->show(true)->excel(),
            DataBuilder::build($this->field_description())->name(__('Description'))->show(false)->excel(),
            DataBuilder::build($this->field_priority())->name(__('Priority'))->excel(),
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

    public function has_location()
    {
        return $this->hasOne(Location::class, Location::field_primary(), self::field_location_id());
    }

    public function has_reported()
    {
        return $this->hasOne(User::class, User::field_primary(), self::field_reported_by());
    }

    public function has_worksheet()
    {
        return $this->hasMany(WorkSheet::class, WorkSheet::field_ticket_code(), self::field_primary());
    }

    public function has_type()
    {
        return $this->hasOne(WorkType::class, WorkType::field_primary(), self::field_work_type_id());
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

            if (empty($model->{self::field_status()})) {
                $model->{self::field_status()} = TicketStatus::Open; $model->{self::field_reported_by()} = auth()->user()->id;
            }

            if (empty($model->{self::field_priority()})) {
                $model->{self::field_priority()} = TicketPriority::Low;
            }

            $model->{self::field_primary()} = Uuid::uuid1()->toString();

        });

        parent::saving(function ($model) {
            if ($model->{self::field_status()} == TicketStatus::Close) {
                $model->{self::field_finished_by()} = auth()->user()->id;
                $model->{self::field_finished_at()} = date('Y-m-d h:i:s');
            }

            if (empty($model->{self::field_reported_by()})) {
                $model->{self::field_reported_by()} = auth()->user()->id;
            }

            if (request()->has('file_picture')) {
                $file_logo = request()->file('file_picture');
                $extension = $file_logo->getClientOriginalExtension();
                $name = time() . '.' . $extension;
                $file_logo->storeAs('public/ticket/', $name);
                $model->{TicketSystem::field_picture()} = $name;

                // if (request()->has('file_old')) {
                //     $path = public_path('storage//ticket//');
                //     $old = request()->get('file_old');
                //     if (file_exists($path . $old)) {
                //         unlink($path . $old);
                //     }
                // }
            }
        });

        parent::boot();
    }

}
