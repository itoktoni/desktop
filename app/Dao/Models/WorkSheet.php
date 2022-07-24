<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\WorkSheetEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;
use Wildside\Userstamps\Userstamps;

class WorkSheet extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, WorkSheetEntity, Userstamps, ActiveTrait, PowerJoins, OptionTrait, SoftDeletes;

    protected $table = 'work_sheet';
    protected $primaryKey = 'work_sheet_code';

    protected $fillable = [
        'work_sheet_code',
        'work_sheet_type_id',
        'work_sheet_name',
        'work_sheet_description',
        'work_sheet_check',
        'work_sheet_result',
        'work_sheet_ticket_code',
        'work_sheet_product_id',
        'work_sheet_reported_at',
        'work_sheet_reported_by',
        'work_sheet_created_at',
        'work_sheet_created_by',
        'work_sheet_updated_at',
        'work_sheet_updated_by',
        'work_sheet_deleted_at',
        'work_sheet_deleted_by',
        'work_sheet_finished_at',
        'work_sheet_finished_by',
    ];

    public $sortable = [
        'work_sheet_code',
        'work_sheet_name',
        'work_sheet_type_id',
        'work_sheet_product_id',
        'work_sheet_ticket_code',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = true;
    public $incrementing = false;

    const CREATED_AT = 'work_sheet_created_at';
    const UPDATED_AT = 'work_sheet_updated_at';
    const DELETED_AT = 'work_sheet_deleted_at';

    const CREATED_BY = 'work_sheet_created_by';
    const UPDATED_BY = 'work_sheet_updated_by';
    const DELETED_BY = 'work_sheet_deleted_by';

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_code())->name('Code')->sort(),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_description())->name('Description'),
            DataBuilder::build($this->field_check())->name('Check'),
            DataBuilder::build($this->field_result())->name('Result'),
            DataBuilder::build($this->field_ticket_code())->name('Ticket ID')->sort()->show(false),
            DataBuilder::build($this->field_type_id())->name('Type ID')->sort(),
            DataBuilder::build($this->field_product_id())->name('Product ID')->sort(),
        ];
    }

    public function has_work_type()
    {

        return $this->hasOne(WorkType::class, WorkType::field_code(), self::field_type_id());
    }

    public function has_product()
    {
        return $this->hasOne(Product::class, Product::field_code(), self::field_product_id());
    }

    public function workTypeIdSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy($this->field_type_id(), $direction);
        return $query;
    }

    public function productIdSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy($this->field_product_id(), $direction);
        return $query;
    }

}
