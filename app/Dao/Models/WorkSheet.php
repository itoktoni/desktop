<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\WorkSheetEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\ExcelTrait;
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
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, WorkSheetEntity, Userstamps, ActiveTrait, PowerJoins, OptionTrait, SoftDeletes, ExcelTrait;

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
        'work_sheet_product_id'
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
        return $this->field_primary();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name('Code')->sort()->excel(),
            DataBuilder::build(WorkType::field_name())->name('Type')->sort()->excel(),
            DataBuilder::build($this->field_name())->name('Name')->show(false)->excel(),
            DataBuilder::build(Product::field_name())->name('Product Name')->sort()->excel(),
            DataBuilder::build($this->field_description())->name('Description')->excel(),
            DataBuilder::build($this->field_check())->name('Check')->show(false),
            DataBuilder::build($this->field_result())->name('Result')->show(false),
            DataBuilder::build($this->field_ticket_code())->name('Ticket ID')->sort()->show(false),
        ];
    }

    public function has_work_type()
    {
        return $this->hasOne(WorkType::class, WorkType::field_primary(), self::field_type_id());
    }

    public function has_product()
    {
        return $this->hasOne(Product::class, Product::field_primary(), self::field_product_id());
    }

    public function workTypeNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(WorkType::field_name(), $direction);
        return $query;
    }

    public function productNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(Product::field_name(), $direction);
        return $query;
    }

}
