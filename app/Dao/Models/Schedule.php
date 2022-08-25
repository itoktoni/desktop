<?php

namespace App\Dao\Models;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\ScheduleEntity;
use App\Dao\Traits\DataTableTrait;
use App\Dao\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Schedule extends Model
{
    use Sortable, FilterQueryString, Sanitizable, DataTableTrait, ScheduleEntity, OptionTrait, PowerJoins;

    protected $table = 'schedule';
    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'schedule_id',
        'schedule_name',
        'schedule_product_id',
        'schedule_description',
        'schedule_number',
        'schedule_every',
        'schedule_date',
        'schedule_notification',
    ];

    public $sortable = [
        'schedule_name',
        'schedule_date',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name('ID')->show(false)->excel(),
            DataBuilder::build($this->field_name())->name('Name')->sort()->excel(),
            DataBuilder::build(Product::field_name())->name('Product Name')->sort()->excel(),
            DataBuilder::build($this->field_description())->name('Description')->excel(),
            DataBuilder::build($this->field_number())->name('Number')->excel(),
            DataBuilder::build($this->field_every())->name('Every')->excel(),
            DataBuilder::build($this->field_date())->name(' Date ')->excel()->sort(),
            DataBuilder::build($this->field_notification())->name('Notification')->sort(),
        ];
    }
    public function has_product()
    {
        return $this->hasOne(Product::class, Product::field_primary(), self::field_product_id());
    }

    public function productNameSortable($query, $direction)
    {
        $query = $this->queryFilter($query);
        $query = $query->orderBy(Product::field_name(), $direction);
        return $query;
    }
}
