<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\SpkEntity;
use App\Dao\Enums\SpkStatus;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\ExcelTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;
use Wildside\Userstamps\Userstamps;

class Spk extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, SpkEntity, ActiveTrait, PowerJoins, OptionTrait, ExcelTrait;

    protected $table = 'spk';
    protected $primaryKey = 'spk_id';

    protected $fillable = [
        'spk_id',
        'spk_vendor_id',
        'spk_date',
        'spk_code',
        'spk_description',
        'spk_product_id',
        'spk_check',
        'spk_result',
        'spk_work_sheet_code',
        'spk_status',
    ];

    public $sortable = [
        'spk_id',
        'spk_product_id',
        'spk_date',
        'spk_work_sheet_code',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function fieldSearching()
    {
        return $this->field_primary();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name('ID')->sort()->excel(),
            DataBuilder::build($this->field_vendor_id())->name('Vendor ID')->excel(),
            DataBuilder::build(Product::field_name())->name('Product Name')->sort()->excel(),
            DataBuilder::build(WorkSheet::field_name())->name('WorkSheet Name')->sort()->excel(),
            DataBuilder::build($this->field_description())->name('Description')->excel(),
            DataBuilder::build($this->field_code())->name('Code')->excel()->show(false),
            DataBuilder::build($this->field_check())->name('Check')->show(false),
            DataBuilder::build($this->field_result())->name('Result')->show(false),
            DataBuilder::build($this->field_status())->name('Status')->class('column-active text-center')->excel(),
            DataBuilder::build($this->field_date())->name('Date')->excel()->show(false),
        ];
    }

    public function has_product()
    {
        return $this->hasOne(Product::class, Product::field_primary(), self::field_product_id());
    }

    public function has_work_sheet()
    {
        return $this->hasOne(WorkSheet::class, WorkSheet::field_primary(), self::field_work_sheet_code());
    }

    public function workSheetNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(WorkSheet::field_name(), $direction);
        return $query;
    }

    public function productNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(Product::field_name(), $direction);
        return $query;
    }

    /*
    using model event
    https://coderflex.com/blog/how-to-use-model-observers-in-laravel
     */

    
}